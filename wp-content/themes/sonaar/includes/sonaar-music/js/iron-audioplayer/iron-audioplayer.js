IRON.audioPlayer = (function ($) {
  "use strict";
  var autoplayEnable;
  var audioPlayer;
  var playlist;

  function initPlayer(player) {
    audioPlayer = player;
    this.audioPlayer = player;
    var waveContainer = this.audioPlayer.find(".player .wave").attr("id");
    playlist = audioPlayer.find(".playlist");
    this.playlist = playlist;
    this.autoplayEnable = audioPlayer.data("autoplay");
    audioPlayer.skin = audioPlayer.parents(".srt_player-container").data("skin");
    audioPlayer.albums = audioPlayer.data("albums");
    audioPlayer.shuffle = audioPlayer.data("shuffle") || false;
    if (audioPlayer.skin == "music") {
      audioPlayer.soundwave = audioPlayer.data("soundwave") || false;
    } else {
      audioPlayer.soundwave = true;
    }
    var defaultSetting = {
      waveProgressColor: iron_vars.sonaar_music.color_progress,
      waveWaveColor: iron_vars.sonaar_music.color_base,
      waveHeight: 70,
      waveAjaxEnabled: false,
      wavePlayAjax: true,
    };
    audioPlayer.settings = defaultSetting;

    if (audioPlayer.skin == "podcast") {
      audioPlayer.settings.waveProgressColor =
        iron_vars.sonaar_music.podcast_color_progress;
      audioPlayer.settings.waveWaveColor =
        iron_vars.sonaar_music.podcast_color_base;
      audioPlayer.settings.waveHeight = 40;
      audioPlayer.settings.waveAjaxEnabled = true;
      audioPlayer.settings.wavePlayAjax = true;
    }

    setPlaylist(playlist, audioPlayer);
    if (playlist.find("li[data-selected]").length) {
      setCurrentTrack(
        playlist.find("li[data-selected]"),
        playlist.find("li[data-selected]").index(),
        audioPlayer
      );
    } else {
      setCurrentTrack(
        playlist.find("li").eq(0),
        playlist.find("li").index(),
        audioPlayer
      );
    }

    setControl(audioPlayer, playlist);
    trackListItemResize();
    $(window).on("resize", function () {
      trackListItemResize();
    });

    if (audioPlayer.data("autoplay")) {
      autoplayEnable = true;
    }
  }

  function setCurrentTrack(track, index, audioPlayer) {
    var albumArt = audioPlayer.find(".album .album-art");
    var album = audioPlayer.find(".album");
    var trackTitle = audioPlayer.find(".track-title");
    var albumTitle = audioPlayer.find(".sr_it-playlist-title");

    if (audioPlayer.skin == "artist") {
      albumTitle = audioPlayer.find(".metadata .album-title");
      trackTitle = audioPlayer.find(".metadata .track-name");
    }

    playlist.currentTrack = index;

    if (track.data("albumart")) {
      album.show();
      albumArt.show();
      if (albumArt.find("img").length) {
        albumArt.find("img").attr("src", track.data("albumart"));
      } else {
        albumArt.css("background-image", "url(" + track.data("albumart") + ")");
      }
    } else {
      album.hide();
      albumArt.hide();
    }

    if (!audioPlayer.hasClass("show-playlist")) {
      albumArt.on("click", function () {
        setContinuousPlayer(index, audioPlayer);
      });
      albumArt.css("cursor", "pointer");
    }
    audioPlayer.data("currentTrack", index);

    if (audioPlayer.skin == "podcast")
      trackTitle.text(track.data("tracktitle"));

    if (audioPlayer.skin == "artist") {
      trackTitle.text(track.data("tracktitle"));
      albumTitle.text(track.data("albumtitle"));
    }

    audioPlayer.find(".progressLoading").css("opacity", "0.75");
  }

  function setPlaylist(playlist, audioPlayer) {
    playlist.find("li").each(function () {
      setSingleTrack($(this), $(this).index(), audioPlayer);
    });
  }

  function setControl(audioPlayer, playlist) {
    audioPlayer.on("click", ".play", function () {
      if (IRON.sonaar.player.playlistID == audioPlayer.albums) {
        IRON.sonaar.player.play();
      } else {
        transfertPlaylist(audioPlayer, playlist);
      }
    });
    audioPlayer.on("click", ".previous", function () {
      previous(audioPlayer, playlist);
    });
    audioPlayer.on("click", ".next", function () {
      next(audioPlayer, playlist);
    });
  }

  function previous(audioPlayer, playlist) {
    if (IRON.sonaar.player.playlistID == audioPlayer.albums) {
      IRON.sonaar.player.previous();
    } else {
      transfertPlaylist(audioPlayer, playlist);
    }
  }

  function next(audioPlayer, playlist) {
    if (IRON.sonaar.player.playlistID == audioPlayer.albums) {
      IRON.sonaar.player.next();
    } else {
      transfertPlaylist(audioPlayer, playlist);
    }
  }

  function setSingleTrack(singleTrack, eq, audioPlayer) {
    singleTrack.find(".audio-track").remove();
    var tracknumber = eq + 1;
    var trackplay = $("<span/>", {
      class: "track-number",
      html:
        '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="10" height="12" x="0px" y="0px" viewBox="0 0 17.5 21.2" style="enable-background:new 0 0 17.5 21.2;" xml:space="preserve"><path d="M0,0l17.5,10.9L0,21.2V0z"></path><rect width="6" height="21.2"></rect><rect x="11.5" width="6" height="21.2"></rect></svg><span class="number">' +
        tracknumber +
        "</span>",
    });
    $("");
    $("<a/>", {
      class: "audio-track",
      click: function (event) {
        if ($(this).parent().attr("data-audiopath").length == 0) {
          return;
        }

        setContinuousPlayer(eq, audioPlayer, event);
        audioPlayer.data("currentTrack", eq);
      },
    })
      .appendTo(singleTrack)
      .prepend(trackplay)
      .append(
        '<div class="tracklist-item-title">' +
        singleTrack.data("tracktitle") +
        "</div>"
      );
  }

  function trackListItemResize() {
    $(".playlist li").each(function () {
      var storeWidth = $(this).find(".store-list").outerWidth();
      var trackWidth = $(this).find(".track-number").outerWidth();
      $(this)
        .find(".tracklist-item-title")
        .css("max-width", $(this).outerWidth() - storeWidth - trackWidth - 10);
    });
  }

  function getPlayer() {
    return this;
  }

  function setContinuousPlayer(eq, audioPlayer) {
    IRON.sonaar.player.setPlaylist(audioPlayer, eq);
  }

  var transfertPlaylist = function (audioPlayer, playlist) {
    IRON.sonaar.player.setPlayer({
      id: audioPlayer.albums,
      trackid: playlist.currentTrack,
      shuffle: audioPlayer.shuffle,
      soundwave: audioPlayer.soundwave,
      notrackskip: audioPlayer.data("no-track-skip"),
    });
  };

  return {
    init: initPlayer,
    getPlayer: getPlayer,
    autoplayEnable: autoplayEnable,
    playlist: playlist,
    audioPlayer: audioPlayer,
  };
})(jQuery);

//Load Music player Content
function setIronAudioplayers() {
  IRON.playersList = [];
  jQuery(".srt_player-container .iron-audioplayer").each(function () {
    var player = Object.create(IRON.audioPlayer);
    player.init(jQuery(this));
    IRON.playersList.push(player);
  });
}

setIronAudioplayers();

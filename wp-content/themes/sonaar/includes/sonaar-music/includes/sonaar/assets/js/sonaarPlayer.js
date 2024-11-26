$ = jQuery

var srp_pluginEnable = (document.querySelector('#sonaarAudio:not(.srt_sticky-player)')) ? false : true; // if mp3 player pro is activated
var srp_pluginWidgetPlayer = (jQuery('.iron_widget_radio:not(.srt_player-container)')) ? false : true; // if at least mp3 player public is activated
var isSafari;

function srt_sonaarPlayer() {
  if (srp_pluginEnable) return;

  var data = {
    list: {
      'playlist_name': false,
      'tracks': false,
      'type': false,
      'random_order': ''
    },
    currentTrack: false,
    playlistID: '',
    showList: false,
    isPlaying: false,
    loading: 0,
    minimize: true,
    wavesurfer: false,
    mediaPlayer: false,
    audioCtx: false,
    audioElement: false,
    audioSrc: false,
    analyser: false,
    frequencyData: false,
    userPref: {
      pause: false,
      minimize: false,
      autoplay: true
    },
    unlock: false,
    playerStatus: '',
    currentTime: '',
    totalTime: '',
    shuffle: false,
    soundwave: false,
    mute: false,
    notrackskip: false,

    classes: {
      enable: false,
      waveEnable: false,
      isPlaying: false,
      playlist: iron_vars.sonaar_music.continuous_playlist_icon,
      author: iron_vars.sonaar_music.continuous_artist_name,
      skipForward: 30,
      skipBackward: 15,
      hideSkipButton: iron_vars.sonaar_music.podcast_skip_button,
      hideSpeedRateButton: iron_vars.sonaar_music.podcast_speed_rate_button,
      artistPrefix: iron_vars.sonaar_music.artist_prefix

    },
    css: {
      progressColor: {
        background: '' + iron_vars.sonaar_music.continuous_progress_bar + '',
        width: '0'
      },
      wavecut: {
        width: '0'
      },
      waveColor: {
        background: '' + iron_vars.sonaar_music.continuous_timeline_background + '',
        opacity: '0.5'
      },
      volumeHandle: {
        height: '100%'
      }
    }

  }






  function webAudioTouchUnlock(context) {
    return new Promise(function (resolve, reject) {
      if (context.state === 'suspended') {
        var unlock = function () {
          context.resume().then(function () {
            document.body.removeEventListener('touchstart', unlock)
            document.body.removeEventListener('touchend', unlock)
            document.body.removeEventListener('click', unlock)
            document.body.removeEventListener('mousedown', unlock)

            resolve(true)
          },
            function (reason) {
              reject(reason)
            })
        }

        document.body.addEventListener('touchstart', unlock, false)
        document.body.addEventListener('touchend', unlock, false)
        document.body.addEventListener('click', unlock, false)
        document.body.addEventListener('mousedown', unlock, false)
      } else {
        resolve(false)
      }
    })
  }

  var sonaarAudio = document.querySelector('#sonaarAudio');
  var AudioContext = window.AudioContext || window.webkitAudioContext
  var sonaarAudioContext = new AudioContext()
  var iOS = !!navigator.platform && /iPad|iPhone|iPod/.test(navigator.platform);
  isSafari = /^((?!chrome|android).)*safari/i.test(navigator.userAgent);

  if (iron_vars.enable_spectrum && !iOS) {

    var sonaarTrack = sonaarAudioContext.createMediaElementSource(sonaarAudio)
    sonaarAudio.crossOrigin = 'anonymous'
    var sonaarAnalyser = sonaarAudioContext.createAnalyser()

    sonaarTrack.connect(sonaarAnalyser)
    sonaarTrack.connect(sonaarAudioContext.destination)

  }





  IRON.sonaar = {
    player: new Vue({
      el: '#sonaar-player',
      data: data,
      methods: {
        play: function () {
          if (this.mediaPlayer.paused) {
            this.userPref.autoplay = true
            this.mediaPlayer.play();
          } else {
            this.pause();
          }
        },
        pause: function () {
          this.mediaPlayer.pause()
          clearInterval(window.renderFauxChartInterval);

        },
        previous: function () {
          if (this.shuffle) {
            var i;
            for (i = 0; i < this.list.random_order.length; i++) {
              if (this.list.random_order[i] == this.currentTrack) {
                if (i == 0) {
                  this.currentTrack = this.list.random_order[this.list.random_order.length - 1];
                } else {
                  this.currentTrack = this.list.random_order[i - 1];
                }
                break;
              }
            }
          } else {
            if ((this.currentTrack - 1) < 0)
              return this.currentTrack = this.list.tracks.length - 1

            this.currentTrack--;
          }

        },
        next: function () {
          if (this.playerStatus == 'next')
            return

          if (this.list.tracks.length > 1) {
            if (this.shuffle) {
              var i;
              for (i = 0; i < this.list.random_order.length; i++) {
                if (this.list.random_order[i] == this.currentTrack) {
                  if (i == this.list.random_order.length - 1) {
                    this.currentTrack = this.list.random_order[0];
                  } else {
                    this.currentTrack = this.list.random_order[i + 1];
                  }
                  break;
                }
              }
            } else {
              if ((this.currentTrack + 1) >= this.list.tracks.length)
                return this.currentTrack = 0

              this.currentTrack++;
            }
          } else { //Has only one track
            this.mediaPlayer.setCurrentTime(0);
          }
        },
        skipBackward: function () {
          this.mediaPlayer.setCurrentTime(this.mediaPlayer.getCurrentTime() - this.classes.skipBackward)
        },
        skipForward: function () {
          this.mediaPlayer.setCurrentTime(this.mediaPlayer.getCurrentTime() + this.classes.skipForward)
        },
        setSpeedRate: function () {
          var rateSpeed = [0.5, 1, 1.2, 1.5, 2]
          var currentRateSpeed = this.mediaPlayer.getPlaybackRate()
          if (currentRateSpeed == rateSpeed[rateSpeed.length - 1]) {
            currentRateSpeed = rateSpeed[0]
          } else {
            $.each(rateSpeed, function () {
              if (this > currentRateSpeed) {
                currentRateSpeed = this
                return false
              }
            })
          }
          this.mediaPlayer.setPlaybackRate(currentRateSpeed)
        },
        skip: function (time) {
          this.mediaPlayer.setCurrentTime(time * this.mediaPlayer.getDuration())
        },

        setPlaylist: function (audioPlayer, eq) {
          var params = audioPlayer.data('url-playlist').slice(audioPlayer.data('url-playlist').indexOf('title')).split('&')
          var title = params[0].slice(6).replace('+++', '&#').replace('++', '&');//Replace the '&' to avoid issue with the data-url-playlist 
          var id = params[1].slice(7)

          this.setPlayer({
            id: id,
            title: title,
            trackid: eq,
            shuffle: audioPlayer.data('shuffle'),
            soundwave: audioPlayer.data('soundwave')
          })
        },

        getPlaylistbyID: function (id, title) {
          var playlistID = id || false
          var title = title || ''
          title = title.replace('&#', '+++')


          if (playlistID)
            return IRON.state.site_url + '?load=playlist.json&title=' + title + '&albums=' + playlistID + ''

          return false
        },

        setPlayer: function (args) {
          var args = args || {}
          var params = {
            id: args.id || null,
            title: args.title || null,
            trackid: args.trackid || 0,
            autoplay: (typeof args.autoplay == 'boolean') ? args.autoplay : true,
            time: args.time || false,
            shuffle: (args.shuffle == true || args.shuffle == 'true' || args.shuffle == '1') ? true : false,
            soundwave: (args.soundwave == true || args.soundwave == 'true' || args.soundwave == '1') ? true : false,
          }
          this.userPref.autoplay = params.autoplay
          this.shuffle = params.shuffle;
          this.soundwave = params.soundwave;

          if (this.list.type == 'podcast') {
            if (params.id && params.id === this.playlistID) {
              return this.play()
            }
          } else {
            if (params.id && params.id === this.playlistID && params.trackid == this.currentTrack) {
              return this.play()
            }
          }

          if (params.id && params.id === this.playlistID && params.trackid !== this.currentTrack)
            this.currentTrack = params.trackid

          if (params.id && params.id !== this.playlistID) {
            $.when($.getJSON(this.getPlaylistbyID(params.id, params.title))).done(function (data) {

              if (!$('body').hasClass('artistPlayer-enable')) {
                IRON.initPusherHeight()
                this.classes.enable = true
                this.minimize = false
                $('body').addClass('continuousPlayer-enable')
              }


              this.list = data

              if (params.autoplay === true || params.autoplay === 'true') {
                this.autoplay = true
              } else {
                this.autoplay = false
              }

              if (params.shuffle === true || params.shuffle === 'true') {
                this.setRandomList();
                this.shuffle = true
              }

              this.playlistID = params.id

              if (this.list.type == 'podcast') {
                for (var i = 0; i < this.list.tracks.length; i++) {
                  var element = this.list.tracks[i]

                  if (element.id == params.id) {
                    this.currentTrack = i
                  }

                }
              } else {
                if (this.shuffle == true) {
                  this.currentTrack = Math.floor(Math.random() * this.list.tracks.length);
                } else {
                  this.currentTrack = params.trackid;
                }
              }


              if (params.time)
                this.skip(params.time)

              this.handleTrackChange()

            }.bind(this))

          }
        },






        getSVG: function (fileUrl) {
          $.ajax({
            url: fileUrl,
            dataType: 'html',
            data: { ajax: 1 },
            success: function (svgDoc) {
              $('[data-svg-url="' + fileUrl + '"]').each(function () {
                if ($(this).html().length == 0) {
                  $(this).append(svgDoc);
                }
              });
            }
          });
        },




        setAudio: function () {
          this.mediaPlayer.setSrc(this.list.tracks[this.currentTrack].mp3);
          $('#sonaarAudio').attr('src', this.list.tracks[this.currentTrack].mp3);
          this.mediaPlayer.load();
          this.addWave();
        },
        setshowList: function () {
          if (this.showList == false) {
            $('#pusher-wrap').addClass('sonaar-list-active')
            return this.showList = true
          }

          $('#pusher-wrap').removeClass('sonaar-list-active')
          return this.showList = false
        },
        closePlayer: function () {
          if (this.showList) {
            $('#pusher-wrap').removeClass('sonaar-list-active')
            this.showList = false
          }
          this.minimize = !this.minimize
          this.classes.enable = !this.classes.enable
        },
        playlistAfterEnter: function () {
          var ps = new PerfectScrollbar("#sonaar-player .playlist .scroll", {
            wheelSpeed: 0.7,
            swipeEasing: true,
            wheelPropagation: false,
            minScrollbarLength: 20,
            suppressScrollX: true,
          });
        },
        scroll: function (event) {
          var el = event.target
          var parent = el.offsetParent

          if (el.offsetWidth > parent.offsetWidth && !el.classList.contains('scrolling')) {
            el.classList.add('scrolling')
            var transformWidth = el.offsetWidth + 10
            el.insertAdjacentHTML('beforeend', '<span class="duplicate">' + el.innerText + '</span>')
            el.style.transform = 'translate( -' + transformWidth + 'px )'
            setTimeout(function () {
              el.classList.remove('scrolling')
              el.style.transform = ''
              el.removeChild(el.firstElementChild)
            }, 6000)
          }
        },
        addWave: function () {

          var svg = d3.selectAll('.wave-custom svg')
          var varheight = [];
          for (var index = 0; index < 950; index++) {
            varheight.push(Math.random() * (30 - 0) + 0)
          }
          svg.selectAll('rect').remove()


          svg.selectAll('rect')
            .data(varheight)
            .enter()
            .append('rect')
            .attr('x', function (d, i) {
              // adjust spectro width total
              return (i * 1) + (i * 1) + 'px'
            })
            .attr('y', function (d) {
              var pos = (30 - d) / 2

              return pos + 'px'
            })
            .attr('height', function (d) {
              var pos = d
              return pos + 'px'
            })
            .attr('fill', function () {
              return iron_vars.sonaar_music.podcast_color_base
            })
            // adjust spectro bar width size
            .attr('width', '0.6')

        },
        updatePlayers: function () {
          var that = this
          $.each(IRON.playersList, function (index, value) {
            IRON.playersList[index].audioPlayer.removeClass('audio-playing')
            that.removeSpectro()
          })

          if (this.isPlaying) {

            if (this.list.type == 'podcast') {
              this.addSpectro(this.list.tracks[this.currentTrack].id)
              $('.srt_player-container .iron-audioplayer[data-albums="' + this.list.tracks[this.currentTrack].id + '"]').addClass('audio-playing')
              $('.srt_player-container .iron-audioplayer[data-albums="' + this.list.tracks[this.currentTrack].id + '"]').find('li').removeClass('current')
              $('.srt_player-container .iron-audioplayer[data-albums="' + this.list.tracks[this.currentTrack].id + '"]').find('li').eq(this.currentTrack).addClass('current')
              return
            }

            this.addSpectro(this.playlistID)
            $('.srt_player-container .iron-audioplayer[data-url-playlist*="' + this.playlistID + '"]').addClass('audio-playing')
            $('.srt_player-container .iron-audioplayer[data-url-playlist*="' + this.playlistID + '"]').find('li').removeClass('current')
            $('.srt_player-container .iron-audioplayer[data-url-playlist*="' + this.playlistID + '"]').find('li').eq(this.currentTrack).addClass('current')
            return
          }

          $('.srt_player-container .iron-audioplayer[data-url-playlist*="' + this.playlistID + '"]').removeClass('audio-playing')
          $('.srt_player-container .iron-audioplayer[data-url-playlist*="' + this.playlistID + '"]').find('li').removeClass('current')
          $('.srt_player-container .iron-audioplayer').find('.spectro').remove()

          var albumTitle = IRON.sonaar.player.list.tracks[IRON.sonaar.player.currentTrack]['album_title'];
          var trackTitle = IRON.sonaar.player.list.tracks[IRON.sonaar.player.currentTrack]['track_title'];
          this.notrackskip = IRON.sonaar.player.list.tracks[IRON.sonaar.player.currentTrack]['no_track_skip'];

          if ($('.srt_player-container .iron-audioplayer[data-url-playlist*="' + this.playlistID + '"] .track-name').text() != '') {//if already have content
            $('.srt_player-container .iron-audioplayer[data-url-playlist*="' + this.playlistID + '"] .track-name').text(trackTitle);
          }
          if ($('.srt_player-container .iron-audioplayer[data-url-playlist*="' + this.playlistID + '"] .album-title').text() != '') {//if already have content
            $('.srt_player-container .iron-audioplayer[data-url-playlist*="' + this.playlistID + '"] .album-title').text(albumTitle);
          }
          if ($('.srt_player-container .iron-audioplayer[data-url-playlist*="' + this.playlistID + '"] .sr_it-playlist-title').text() != '') {//if already have content
            $('.srt_player-container .iron-audioplayer[data-url-playlist*="' + this.playlistID + '"] .sr_it-playlist-title').text(albumTitle);
          }

        },
        removeSpectro: function () {
          $.each(IRON.playersList, function (index) {
            $('.srt_player-container .iron-audioplayer').find('.spectro').remove()
          })
        },
        addSpectro: function (playlistID) {
          if (!this.soundwave)
            return

          var container = $('.srt_player-container .iron-audioplayer[data-albums="' + playlistID + '"]').find('.player')
          var spectro = $('<div/>', {
            class: 'spectro'
          })
          spectro.prependTo(container)


          var svgHeight = '100'
          var svgWidth = '1200'


          function createSvg(parent) {
            return d3.select(parent).append('svg').attr('height', '100%').attr('width', '100%')
          }

          var svg = createSvg('.spectro', svgHeight, svgWidth)

          var frequencyData = this.frequencyData
          svg.selectAll('rect')
            .data(frequencyData)
            .enter()
            .append('rect')
            .attr('x', function (d, i) {
              // adjust spectro width total
              return i / 1.5 + '%'
            })
            // adjust spectro bar width size
            .attr('width', '2')

          // Continuously loop and update chart with frequency data.
          function renderChart() {
            requestAnimationFrame(renderChart)

            // Copy frequency data to frequencyData array.
            sonaarAnalyser.getByteFrequencyData(frequencyData)

            // Update d3 chart with new data.
            svg.selectAll('rect')
              .data(frequencyData)
              .attr('y', function (d) {
                var pos = svgHeight - (d / 255) * 100

                return pos + '%'
              })
              .attr('height', function (d) {
                var pos = (d / 255) * 100
                return pos + '%'
              })
              .attr('fill', function () {
                return iron_vars.sonaar_music.podcast_color_base
              })


          }


          window.renderFauxChart = function () {
            var varheight = [];
            for (var index = 0; index < 170; index++) {
              varheight.push(Math.random() * (100 - 0) + 0)
            }
            svg.selectAll('rect')
              .data(varheight)
              .transition()
              .attr('y', function (d) {
                var pos = svgHeight - d

                return pos + '%'
              })
              .attr('height', function (d) {
                var pos = d
                return pos + '%'
              })
              .attr('fill', function () {
                return iron_vars.sonaar_music.podcast_color_base
              })
          }

          // Run the loop
          if (iron_vars.enable_spectrum) {
            renderChart()
          } else {
            clearInterval(window.renderFauxChartInterval);
            window.renderFauxChartInterval = setInterval('window.renderFauxChart()', 100)
          }
          $('.spectro').animate({
            opacity: 1
          }, 1000, function () { });
        },


        skipTo: function (event) { //When we navigate through the progress bar
          this.skip(event.layerX / event.target.clientWidth)
        },

        setVolume: function () {
          $(this.$el).find('.volume .slide').slider({
            orientation: 'vertical',
            range: 'min',
            min: 0,
            max: 100,
            value: 100,
            slide: function (event, ui) {
              IRON.sonaar.player.mediaPlayer.setVolume(ui.value / 100)
              IRON.sonaar.player.mediaPlayer.setMuted(false)
              IRON.sonaar.player.mute = false
            }
          })
        },

        muteTrigger: function () {
          if (this.mute) {
            this.mute = false
          } else {
            this.mute = true
          }
          this.mediaPlayer.setMuted(this.mute)
        },

        enableRandomList: function () {
          if (this.shuffle) {
            this.shuffle = false;
          } else {
            this.shuffle = true;
            this.setRandomList();
          }
        },

        showCTA: function () {
          if ($('#sonaar-player.srt_sticky-player.enable .store').hasClass('opened')) {
            $('#sonaar-player.srt_sticky-player.enable .store').removeClass('opened');
          } else {
            $('#sonaar-player.srt_sticky-player.enable .store').addClass('opened');
          }
        },

        setRandomList: function () {
          var poolTrack = new Array;
          var i = 0;
          this.list.tracks.forEach(function () {
            poolTrack.push(i);
            i++;
            poolTrack = poolTrack.sort(function (a, b) { return 0.5 - Math.random() });
          });
          this.list.random_order = poolTrack;
        },

        handleTrackChange: function () {
          this.isPlaying = false
          this.classes.waveEnable = false
          this.setAudio()
          this.updatePlayers()

        },
        handleVisibilityChange: function () {
          if (document.visibilityState == 'hidden') {
            clearInterval(window.renderFauxChartInterval);
          } else {
            if (!iron_vars.enable_spectrum) {
              if (this.isPlaying) {
                clearInterval(window.renderFauxChartInterval);
                window.renderFauxChartInterval = setInterval('window.renderFauxChart()', 100)
              }
            }

          }

        }
      },
      computed: {
        playerClass: function () {
          return 'list-type-' + this.list.type + ' srt_sticky-player'
        },
        playerCallToAction: function () {
          if (this.list.type == 'podcast') {
            return this.list.tracks[this.currentTrack].podcast_calltoaction
          } else {
            return this.list.tracks[this.currentTrack].song_store_list
          }
        },
        storeWidth: function () {
          if (this.list.type != 'podcast') {
            return (this.list.tracks[this.currentTrack].song_store_list).length * 75 + 'px'
          }
        },
        hasArtwork: function () {
          var strURL = this.list.tracks[this.currentTrack].poster
          return !strURL.endsWith('default.png')
        },
        hideDuration: function () {
          if (this.list.type == 'podcast' && iron_vars.sonaar_music.podcast_hide_duration != false) {
            return true
          } else {
            return false
          }
        },
        hideCategory: function () {
          if (this.list.type == 'podcast' && iron_vars.sonaar_music.podcast_hide_category != false) {
            return true
          } else {
            return false
          }
        },
        hideSkipButton: function () {
          if (this.list.type == 'podcast' && iron_vars.sonaar_music.podcast_skip_button != false) {
            return true
          } else {
            return false
          }
        },
        hideSpeedRateButton: function () {
          if (this.list.type == 'podcast' && iron_vars.sonaar_music.podcast_speed_rate_button != false) {
            return true
          } else {
            return false
          }
        },
        playListTitle: function () {
          if (this.list.type == 'podcast') {
            return this.list.tracks[0].album_title;
          } else {
            if (this.list.playlist_name == "") {
              return this.list.tracks[this.currentTrack].album_title;
            } else {
              return this.list.playlist_name;
            }
          }
        },

      },
      mounted: function () {
        this.$nextTick(function () {

          this.frequencyData = new Uint8Array(170)

          d3.selectAll('.wave-progress, .wave-base').append('svg').attr('height', '100%').attr('width', '100%')

          document.addEventListener('visibilitychange', this.handleVisibilityChange, false);


          this.mediaPlayer = new MediaElement(sonaarAudio, {
            success: function (mediaElement, originalNode, instance) { }
          });


          this.mediaPlayer.addEventListener('canplay', function () {
            if (this.autoplay) {
              this.mediaPlayer.play();
            } else {
              this.autoplay = true;
            }
          }.bind(this))


          this.mediaPlayer.addEventListener('play', function () {
            this.playerStatus = 'play';
            this.isPlaying = true
            $('.sonaar-podcast-list-item.current').addClass('playing')
          }.bind(this))

          this.mediaPlayer.addEventListener('pause', function () {
            this.isPlaying = false
            this.userPref.pause = true
            $('.sonaar-podcast-list-item.current').removeClass('playing')
          }.bind(this))

          this.mediaPlayer.addEventListener('ended', function () {
            if (this.notrackskip != 1) {
              this.next()
              this.playerStatus = 'next'
            }
          }.bind(this))


          this.mediaPlayer.addEventListener('timeupdate', function () {
            var currentTime = this.mediaPlayer.getCurrentTime();
            var duration = this.mediaPlayer.getDuration();
            var time = moment.duration(currentTime, 'seconds')

            $('.wave-cut').stop(true, true).animate({ 'width': (currentTime + .25) / duration * 100 + '%' }, 250, 'linear');
            $('.progressDot').stop(true, true).animate({ 'left': (currentTime + .25) / duration * 100 + '%' }, 250, 'linear');

            if (time.hours() > 0) {
              this.currentTime = moment(time.hours() + ':' + time.minutes() + ':' + time.seconds(), 'h:m:s').format('h:mm:ss')
            } else {
              this.currentTime = moment(time.minutes() + ':' + time.seconds(), 'm:s').format('mm:ss')
            }

            if (duration !== Infinity) {
              var totalTime = moment.duration(duration - currentTime, 'seconds')
              if (totalTime.hours() >= 12 || totalTime.hours() <= 0) {
                this.totalTime = '-' + moment(totalTime.minutes() + ':' + totalTime.seconds(), 'm:s').format('mm:ss')
              } else {
                this.totalTime = '-' + moment(totalTime.hours() + ':' + totalTime.minutes() + ':' + totalTime.seconds(), 'h:m:s').format('h:mm:ss')
              }

            } else {
              this.totalTime = this.list.tracks[this.currentTrack].length
            }

          }.bind(this))




          webAudioTouchUnlock(sonaarAudioContext).then(function (unlocked) {
            if (unlocked) {
              this.unlock = true
            } else {
              this.unlock = true
            }
          }.bind(this))


          this.setVolume()


        })
      },
      watch: {


        currentTrack: function () {
          this.handleTrackChange()
        },
        isPlaying: function () {
          this.updatePlayers()
        },
        minimize: function () {
          this.userPref.minimize = this.minimize
          if (this.minimize) {
            $('body').removeClass('continuousPlayer-enable')
          } else {
            $('body').addClass('continuousPlayer-enable')
          }
        }
      }
    })
  }
}
srt_sonaarPlayer();

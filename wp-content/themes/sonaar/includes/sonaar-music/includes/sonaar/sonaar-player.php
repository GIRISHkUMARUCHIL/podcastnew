<div id="sonaar-player" :class="[{enable: !minimize , 'show-list': showList, 'hide-track-lenght': hideDuration, 'hide-track-category': hideCategory, 'hide-skip-button': hideSkipButton, 'hide-speed-rate-button': hideSpeedRateButton, 'hideArtistName': classes.author }, playerClass]">

  <audio id="sonaarAudio" src=""></audio>

  <transition name="sonaar-player-slidefade" v-on:after-enter="playlistAfterEnter">
    <div class="playlist" v-if="showList">
      <div class="scroll">
        <div class="container">
          <div class="boxed">
            <div class="playlist-title" v-if="(playListTitle)">{{playListTitle}}</div>
            <div class="track-artist" v-if="!classes.author && list.tracks[currentTrack].album_artist != false" v-html="classes.artistPrefix + ' ' + list.tracks[currentTrack].album_artist"></div>
            <div class="shuffle" @click="enableRandomList" v-if="list.type!='podcast'">
              <div v-if="shuffle">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0px" y="0px"
                viewBox="0 0 22 22" style="enable-background:new 0 0 22 22;" xml:space="preserve">
                  <path d="M18.2,13.2c-0.1-0.1-0.4-0.1-0.5,0c-0.1,0.1-0.1,0.4,0,0.5l2.1,2h-3.6c-0.9,0-2.1-0.6-2.7-1.3L10.9,11l2.7-3.4
                  c0.6-0.7,1.8-1.3,2.7-1.3h3.6l-2.1,2c-0.1,0.1-0.1,0.4,0,0.5c0.1,0.1,0.2,0.1,0.3,0.1c0.1,0,0.2,0,0.3-0.1L21,6.2
                  c0.1-0.1,0.1-0.2,0.1-0.3c0-0.1,0-0.2-0.1-0.3L18.2,3c-0.1-0.1-0.4-0.1-0.5,0c-0.1,0.1-0.1,0.4,0,0.5l2.1,2h-3.6
                  c-1.1,0-2.5,0.7-3.2,1.6l-2.6,3.3L7.8,7.1C7.1,6.2,5.7,5.5,4.6,5.5H1.3c-0.2,0-0.4,0.2-0.4,0.4c0,0.2,0.2,0.4,0.4,0.4h3.3
                  c0.9,0,2.1,0.6,2.7,1.3L9.9,11l-2.7,3.4c-0.6,0.7-1.8,1.3-2.7,1.3H1.3c-0.2,0-0.4,0.2-0.4,0.4c0,0.2,0.2,0.4,0.4,0.4h3.3
                  c1.1,0,2.5-0.7,3.2-1.6l2.6-3.3l2.6,3.3c0.7,0.9,2.1,1.6,3.2,1.6h3.6l-2.1,2c-0.1,0.1-0.1,0.4,0,0.5c0.1,0.1,0.2,0.1,0.3,0.1
                  c0.1,0,0.2,0,0.3-0.1l2.7-2.7c0.1-0.1,0.1-0.2,0.1-0.3c0-0.1,0-0.2-0.1-0.3L18.2,13.2z"/>
                </svg>
              </div>
              <div v-else>
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="20" height="20" x="0px" y="0px"
              viewBox="0 0 22 22" style="enable-background:new 0 0 22 22;" xml:space="preserve">
                  <path d="M19,15.4H3.2l2.8-2.7c0.1-0.1,0.1-0.3,0-0.5c-0.1-0.1-0.3-0.1-0.5,0l-3.3,3.3C2.1,15.5,2,15.6,2,15.7c0,0.1,0,0.2,0.1,0.2
                  l3.3,3.3c0.1,0.1,0.1,0.1,0.2,0.1c0.1,0,0.2,0,0.2-0.1c0.1-0.1,0.1-0.3,0-0.5L3.2,16H19c0.2,0,0.3-0.1,0.3-0.3
                  C19.3,15.5,19.1,15.4,19,15.4z M20.3,7.2l-3.3-3.3c-0.1-0.1-0.3-0.1-0.5,0c-0.1,0.1-0.1,0.3,0,0.5l2.8,2.7H3.5
                  c-0.2,0-0.3,0.1-0.3,0.3c0,0.2,0.1,0.3,0.3,0.3h15.8l-2.8,2.7c-0.1,0.1-0.1,0.3,0,0.5c0.1,0.1,0.1,0.1,0.2,0.1c0.1,0,0.2,0,0.2-0.1
                  l3.3-3.3c0.1-0.1,0.1-0.1,0.1-0.2C20.4,7.3,20.3,7.3,20.3,7.2z"/>
                </svg>
              </div>
            </div>
            <button class="play" @click="play" v-if="isPlaying"><?php echo translateString('tr_pause'); ?></button>
            <button class="play" @click="play" v-if="!isPlaying"><?php echo translateString('tr_play'); ?></button>
            <div class="trackscroll">
              <ul class="tracklist">
                <li v-for="(track, index) in list.tracks" :key="track.id" @click="currentTrack = index" :class="index == currentTrack ? 'active' : '' ">
                  <span class="track-status">{{ index + 1 }}</span>
                  <span class="track-title"><span class="content" @mouseover="scroll">{{ track.track_title }}</span></span>
                  <span class="track-album"><span class="content">{{ track.album_title }}</span></span>
                  <span class="track-lenght" v-if="track.lenght"><span class="content">{{ track.lenght }}</span></span>
                  <span class="track-store" v-if="(list.type=='album' && track.song_store_list ) || (list.type=='podcast' && track.podcast_calltoaction )">
                    <a v-for="store in track.song_store_list" :href="store.store_link" :target="store.store_link_target"  :download=" (store.song_store_icon == 'fas fa-download')? '': false " v-if="list.type!='podcast'">
                      <i class="fa" :class="store.song_store_icon" v-if="store.song_store_icon != 'custom-icon'"></i>
                      <div class="sr_svg-box" :data-svg-url="store.sr_icon_file" v-if="store.song_store_icon == 'custom-icon'">{{getSVG(store.sr_icon_file)}}</div>
                    </a>
                    
                    <a v-for="button in track.podcast_calltoaction" :href="button.podcast_button_link" :target="  (button.podcast_button_target)?'_blank':'_self'  " class="sonaar-callToAction" v-if="list.type=='podcast'">{{button.podcast_button_name}}</a>
                  </span>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>

  </transition>

  <div class="close btn_playlist" v-if="showList" @click="setshowList"></div>
  <div class="close btn-player" :class="{enable: !minimize, 'storePanel':list.tracks && playerCallToAction}" @click="closePlayer" v-if="list.tracks">
    <svg class="audioBar" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="16" height="16" x="0px" y="0px" viewBox="0 0 17 17" enable-background="new 0 0 17 17" xml:space="preserve">
      <rect x="0" width="2" height="16" transform="translate(0)">
        <animate attributeName="height" attributeType="XML" dur="1s" values="2;16;2" repeatCount="indefinite" />
      </rect>
      <rect x="5" width="2" height="16" transform="translate(0)">
        <animate attributeName="height" attributeType="XML" dur="1s" values="2;16;2" repeatCount="indefinite" begin="0.3s" />
      </rect>
      <rect x="10" width="2" height="16" transform="translate(0)">
        <animate attributeName="height" attributeType="XML" dur="1s" values="2;16;2" repeatCount="indefinite" begin="0.5s" />
      </rect>
      <rect x="15" width="2" height="16" transform="translate(0)">
        <animate attributeName="height" attributeType="XML" dur="1s" values="2;16;2" repeatCount="indefinite" begin="0.3s" />
      </rect>
    </svg>
  </div>

  <div :class="(list.tracks.length >= 2)?'player ':'player no-list '">
    <div class="mobileProgress">
      <div class="skip" @mouseup="skipTo"></div>
      <div class="mobileProgressing wave-cut" :style=" css.wavecut "></div>
      <div class="progressDot" :style=" css.progressDot "></div>
    </div>
    <div class="player-row">

      <div class="playerNowPlaying" v-if="list.tracks">
        <div class="album-art" :class="{'loading': loading < 100 }" v-if="hasArtwork">
          <i class="fa-solid fa-circle-notch fa-spin fa-2x fa-fw loading-icon"></i>
          <img class="hover" :src="list.tracks[currentTrack].poster" />
          <img :src="list.tracks[currentTrack].poster" />
        </div>
        <div :class="(hasArtwork)?'metadata ':'metadata no-image '">
          <div class="track-name" @mouseover="scroll">{{list.tracks[currentTrack].track_title}}</div>
          <div class="track-album" @mouseover="scroll" v-if="list.tracks[currentTrack].album_title">{{list.tracks[currentTrack].album_title}}</div>
          <div class="track-artist" @mouseover="scroll" v-html="classes.artistPrefix + ' ' + list.tracks[currentTrack].album_artist" v-if="!classes.author && list.tracks[currentTrack].album_artist"></div>
        </div>
      </div>
      <div class="playerNowPlaying" v-else></div>
      <div class="control">
        <div class="list" @click="setshowList" v-if="!classes.playlist && list.tracks.length > 1">
          <svg width="24" height="20" viewBox="0 0 24 20" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" xml:space="preserve">
            <g>
              <rect x="0" y="0" width="24" height="2" />
              <rect x="0" y="6" width="24" height="2" />
              <rect x="0" y="12" width="24" height="2" />
              <rect x="0" y="18" width="15" height="2" />
            </g>
          </svg>
        </div>
        <div class="sr_skipBackward" @click="skipBackward" v-if="list.type=='podcast' && classes.hideSkipButton==false">
          <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="26" height="26" x="0px" y="0px"
            viewBox="0 0 350 350" style="enable-background:new 0 0 350 350;" xml:space="preserve">
          <path class="st0" d="M92.99,53.26c50.47-37.73,117.73-40.35,170.62-7.61l-21.94,16.61c0,0,0,0,0,0c0,0,0,0,0,0l0,0c0,0,0,0,0,0
            c-3.86,2.92-6.03,7.4-6.03,12.07c0,1.29,0.16,2.59,0.5,3.88c1.43,5.43,5.72,9.49,11.52,10.94c0,0,0,0,0,0l61.38,17.66c0,0,0,0,0,0
            c0,0,0,0,0,0l0,0c0,0,0,0,0,0c4.15,1.19,8.7,0.37,12.16-2.22c3.47-2.59,5.56-6.71,5.59-11.04c0,0,0,0,0-0.01c0,0,0,0,0-0.01
            l0.42-65.18c0-0.02,0-0.03,0-0.05c0-0.02,0-0.04,0-0.06c0.02-6-2.71-10.99-7.54-13.69c-5.23-2.93-11.7-2.48-16.5,1.14c0,0,0,0,0,0
            c0,0,0,0,0,0l-26.11,19.76c-13.29-8.89-27.71-15.81-42.95-20.6C217.39,9.61,200,7.02,182.44,7.18c-17.56,0.15-34.91,3.04-51.54,8.58
            c-17.03,5.67-32.98,14.01-47.41,24.8c-2.08,1.56-3.18,3.94-3.18,6.36c0,1.65,0.51,3.32,1.58,4.74
            C84.51,55.16,89.48,55.88,92.99,53.26z M310.96,90.86l-58.55-16.84l29.03-21.97c0.45-0.27,0.87-0.59,1.27-0.96l28.65-21.68
            L310.96,90.86z"/>
          <path class="st0" d="M36.26,139.69l1.6-6.62l3.4-10.4l3.99-10.18l4.75-9.7l5.57-9.36l6.18-8.97l6.77-8.37l7.58-8.2
            c2.97-3.22,2.78-8.23-0.44-11.21c-3.22-2.97-8.23-2.78-11.21,0.44l-7.76,8.39c-0.12,0.13-0.23,0.26-0.34,0.4l-7.13,8.81
            c-0.13,0.16-0.25,0.32-0.37,0.49l-6.5,9.44c-0.1,0.14-0.19,0.29-0.28,0.44l-5.87,9.86c-0.11,0.19-0.21,0.38-0.31,0.57l-5.03,10.28
            c-0.09,0.19-0.18,0.39-0.26,0.59l-4.2,10.7c-0.06,0.14-0.11,0.29-0.15,0.43l-3.57,10.91c-0.06,0.2-0.12,0.4-0.17,0.6l-1.68,6.92
            c-0.15,0.63-0.23,1.26-0.23,1.87c0,3.58,2.44,6.82,6.07,7.7C30.94,146.56,35.23,143.94,36.26,139.69z"/>
          <path class="st0" d="M70.09,275.38l-7.14-8.56l-6.14-8.72l-5.59-9.38l-4.99-9.79l-4.2-10l-3.59-10.18l-2.78-10.52l-1.99-10.75
            l-1.19-10.75l-0.4-10.78l0.2-7.72c0.12-4.37-3.34-8.02-7.72-8.14c-4.38-0.12-8.02,3.34-8.14,7.72l-0.21,7.97c0,0.07,0,0.14,0,0.21
            c0,0.1,0,0.2,0.01,0.29l0.42,11.33c0.01,0.19,0.02,0.39,0.04,0.58l1.26,11.33c0.02,0.19,0.05,0.38,0.08,0.57l2.1,11.33
            c0.04,0.2,0.08,0.39,0.13,0.58l2.94,11.12c0.05,0.21,0.12,0.41,0.19,0.61l3.78,10.7c0.05,0.15,0.11,0.29,0.17,0.43l4.4,10.49
            c0.08,0.18,0.16,0.36,0.25,0.53l5.24,10.28c0.08,0.15,0.16,0.31,0.25,0.45l5.87,9.86c0.1,0.17,0.21,0.34,0.33,0.51l6.5,9.23
            c0.12,0.18,0.25,0.35,0.39,0.51l7.34,8.81c2.8,3.37,7.81,3.82,11.17,1.02C72.44,283.75,72.9,278.75,70.09,275.38z"/>
          <path class="st0" d="M185.89,342.5l11.54-0.63c0.15-0.01,0.3-0.02,0.44-0.04l3.78-0.42c4.35-0.48,7.49-4.41,7.01-8.76
            c-0.48-4.35-4.41-7.49-8.76-7.01l-3.55,0.39l-10.95,0.6l-10.75-0.4l-10.82-1l-10.75-1.79l-10.6-2.6l-10.31-3.17l-9.91-4.16
            l-9.84-4.82l-9.39-5.39l-9.17-6.18l-2.71-2.13c-3.44-2.71-8.43-2.11-11.14,1.34c-1.14,1.45-1.7,3.18-1.7,4.9
            c0,2.35,1.04,4.68,3.03,6.24l2.94,2.31c0.15,0.12,0.31,0.23,0.47,0.34l9.65,6.5c0.16,0.11,0.32,0.21,0.48,0.3l9.86,5.66
            c0.15,0.09,0.31,0.17,0.46,0.25l10.28,5.03c0.14,0.07,0.28,0.13,0.42,0.19l10.49,4.41c0.24,0.1,0.49,0.19,0.74,0.27l10.91,3.36
            c0.15,0.05,0.29,0.09,0.44,0.12l11.12,2.73c0.19,0.05,0.39,0.09,0.59,0.12l11.33,1.89c0.19,0.03,0.38,0.06,0.57,0.07l11.33,1.05
            c0.15,0.01,0.29,0.02,0.44,0.03l11.33,0.42C185.41,342.52,185.65,342.52,185.89,342.5z"/>
          <path class="st0" d="M316.46,248.51l-3.87,6.52l-6.21,9.22l-6.58,8.37l-7.37,8.17l-7.77,7.37l-8.38,6.98l-8.96,6.37l-9.18,5.59
            l-9.58,4.99l-10.14,4.38l-10.19,3.46c-3.3,1.12-5.38,4.21-5.38,7.51c0,0.85,0.14,1.71,0.42,2.55c1.41,4.15,5.92,6.37,10.06,4.96
            l10.49-3.57c0.2-0.07,0.4-0.14,0.59-0.23l10.7-4.62c0.18-0.08,0.35-0.16,0.52-0.25l10.07-5.24c0.16-0.08,0.31-0.17,0.46-0.26
            l9.65-5.87c0.16-0.1,0.32-0.2,0.47-0.31l9.44-6.71c0.17-0.12,0.33-0.24,0.48-0.37l8.81-7.34c0.13-0.11,0.26-0.22,0.38-0.34
            l8.18-7.76c0.15-0.14,0.29-0.29,0.43-0.44l7.76-8.6c0.12-0.13,0.24-0.27,0.35-0.41l6.92-8.81c0.12-0.15,0.23-0.31,0.34-0.47
            l6.5-9.65c0.08-0.13,0.17-0.25,0.24-0.38l3.99-6.71c2.24-3.77,1-8.63-2.77-10.87C323.56,243.51,318.69,244.75,316.46,248.51z"/>
          </svg>
          <div class="sr_skip_number">{{classes.skipBackward}}</div>
        </div>
        <div class="sr_skipForward" @click="skipForward" v-if="list.type=='podcast' && classes.hideSkipButton==false">
          <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="26" height="26" x="0px" y="0px"
            viewBox="0 0 350 350" style="enable-background:new 0 0 350 350;" xml:space="preserve">
          <path class="st0" d="M92.99,53.26c50.47-37.73,117.73-40.35,170.62-7.61l-21.94,16.61c0,0,0,0,0,0c0,0,0,0,0,0l0,0c0,0,0,0,0,0
            c-3.86,2.92-6.03,7.4-6.03,12.07c0,1.29,0.16,2.59,0.5,3.88c1.43,5.43,5.72,9.49,11.52,10.94c0,0,0,0,0,0l61.38,17.66c0,0,0,0,0,0
            c0,0,0,0,0,0l0,0c0,0,0,0,0,0c4.15,1.19,8.7,0.37,12.16-2.22c3.47-2.59,5.56-6.71,5.59-11.04c0,0,0,0,0-0.01c0,0,0,0,0-0.01
            l0.42-65.18c0-0.02,0-0.03,0-0.05c0-0.02,0-0.04,0-0.06c0.02-6-2.71-10.99-7.54-13.69c-5.23-2.93-11.7-2.48-16.5,1.14c0,0,0,0,0,0
            c0,0,0,0,0,0l-26.11,19.76c-13.29-8.89-27.71-15.81-42.95-20.6C217.39,9.61,200,7.02,182.44,7.18c-17.56,0.15-34.91,3.04-51.54,8.58
            c-17.03,5.67-32.98,14.01-47.41,24.8c-2.08,1.56-3.18,3.94-3.18,6.36c0,1.65,0.51,3.32,1.58,4.74
            C84.51,55.16,89.48,55.88,92.99,53.26z M310.96,90.86l-58.55-16.84l29.03-21.97c0.45-0.27,0.87-0.59,1.27-0.96l28.65-21.68
            L310.96,90.86z"/>
          <path class="st0" d="M36.26,139.69l1.6-6.62l3.4-10.4l3.99-10.18l4.75-9.7l5.57-9.36l6.18-8.97l6.77-8.37l7.58-8.2
            c2.97-3.22,2.78-8.23-0.44-11.21c-3.22-2.97-8.23-2.78-11.21,0.44l-7.76,8.39c-0.12,0.13-0.23,0.26-0.34,0.4l-7.13,8.81
            c-0.13,0.16-0.25,0.32-0.37,0.49l-6.5,9.44c-0.1,0.14-0.19,0.29-0.28,0.44l-5.87,9.86c-0.11,0.19-0.21,0.38-0.31,0.57l-5.03,10.28
            c-0.09,0.19-0.18,0.39-0.26,0.59l-4.2,10.7c-0.06,0.14-0.11,0.29-0.15,0.43l-3.57,10.91c-0.06,0.2-0.12,0.4-0.17,0.6l-1.68,6.92
            c-0.15,0.63-0.23,1.26-0.23,1.87c0,3.58,2.44,6.82,6.07,7.7C30.94,146.56,35.23,143.94,36.26,139.69z"/>
          <path class="st0" d="M70.09,275.38l-7.14-8.56l-6.14-8.72l-5.59-9.38l-4.99-9.79l-4.2-10l-3.59-10.18l-2.78-10.52l-1.99-10.75
            l-1.19-10.75l-0.4-10.78l0.2-7.72c0.12-4.37-3.34-8.02-7.72-8.14c-4.38-0.12-8.02,3.34-8.14,7.72l-0.21,7.97c0,0.07,0,0.14,0,0.21
            c0,0.1,0,0.2,0.01,0.29l0.42,11.33c0.01,0.19,0.02,0.39,0.04,0.58l1.26,11.33c0.02,0.19,0.05,0.38,0.08,0.57l2.1,11.33
            c0.04,0.2,0.08,0.39,0.13,0.58l2.94,11.12c0.05,0.21,0.12,0.41,0.19,0.61l3.78,10.7c0.05,0.15,0.11,0.29,0.17,0.43l4.4,10.49
            c0.08,0.18,0.16,0.36,0.25,0.53l5.24,10.28c0.08,0.15,0.16,0.31,0.25,0.45l5.87,9.86c0.1,0.17,0.21,0.34,0.33,0.51l6.5,9.23
            c0.12,0.18,0.25,0.35,0.39,0.51l7.34,8.81c2.8,3.37,7.81,3.82,11.17,1.02C72.44,283.75,72.9,278.75,70.09,275.38z"/>
          <path class="st0" d="M185.89,342.5l11.54-0.63c0.15-0.01,0.3-0.02,0.44-0.04l3.78-0.42c4.35-0.48,7.49-4.41,7.01-8.76
            c-0.48-4.35-4.41-7.49-8.76-7.01l-3.55,0.39l-10.95,0.6l-10.75-0.4l-10.82-1l-10.75-1.79l-10.6-2.6l-10.31-3.17l-9.91-4.16
            l-9.84-4.82l-9.39-5.39l-9.17-6.18l-2.71-2.13c-3.44-2.71-8.43-2.11-11.14,1.34c-1.14,1.45-1.7,3.18-1.7,4.9
            c0,2.35,1.04,4.68,3.03,6.24l2.94,2.31c0.15,0.12,0.31,0.23,0.47,0.34l9.65,6.5c0.16,0.11,0.32,0.21,0.48,0.3l9.86,5.66
            c0.15,0.09,0.31,0.17,0.46,0.25l10.28,5.03c0.14,0.07,0.28,0.13,0.42,0.19l10.49,4.41c0.24,0.1,0.49,0.19,0.74,0.27l10.91,3.36
            c0.15,0.05,0.29,0.09,0.44,0.12l11.12,2.73c0.19,0.05,0.39,0.09,0.59,0.12l11.33,1.89c0.19,0.03,0.38,0.06,0.57,0.07l11.33,1.05
            c0.15,0.01,0.29,0.02,0.44,0.03l11.33,0.42C185.41,342.52,185.65,342.52,185.89,342.5z"/>
          <path class="st0" d="M316.46,248.51l-3.87,6.52l-6.21,9.22l-6.58,8.37l-7.37,8.17l-7.77,7.37l-8.38,6.98l-8.96,6.37l-9.18,5.59
            l-9.58,4.99l-10.14,4.38l-10.19,3.46c-3.3,1.12-5.38,4.21-5.38,7.51c0,0.85,0.14,1.71,0.42,2.55c1.41,4.15,5.92,6.37,10.06,4.96
            l10.49-3.57c0.2-0.07,0.4-0.14,0.59-0.23l10.7-4.62c0.18-0.08,0.35-0.16,0.52-0.25l10.07-5.24c0.16-0.08,0.31-0.17,0.46-0.26
            l9.65-5.87c0.16-0.1,0.32-0.2,0.47-0.31l9.44-6.71c0.17-0.12,0.33-0.24,0.48-0.37l8.81-7.34c0.13-0.11,0.26-0.22,0.38-0.34
            l8.18-7.76c0.15-0.14,0.29-0.29,0.43-0.44l7.76-8.6c0.12-0.13,0.24-0.27,0.35-0.41l6.92-8.81c0.12-0.15,0.23-0.31,0.34-0.47
            l6.5-9.65c0.08-0.13,0.17-0.25,0.24-0.38l3.99-6.71c2.24-3.77,1-8.63-2.77-10.87C323.56,243.51,318.69,244.75,316.46,248.51z"/>
          </svg>
          <div class="sr_skip_number">{{classes.skipForward}}</div>
        </div>
        <div class="previous" @click="previous" v-if="list.type!='podcast'">
          <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  width="17.42" height="20" x="0px" y="0px" viewBox="0 0 10.2 11.7" style="enable-background:new 0 0 10.2 11.7;" xml:space="preserve">
            <polygon points="10.2,0 1.4,5.3 1.4,0 0,0 0,11.7 1.4,11.7 1.4,6.2 10.2,11.7"></polygon>
          </svg>
        </div>
        <div class="play" @click="play" :class="{'audio-playing': isPlaying }">
          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20.64" height="25" x="0px" y="0px" viewBox="0 0 17.5 21.2" style="enable-background:new 0 0 17.5 21.2;" xml:space="preserve">
            <path d="M0,0l17.5,10.9L0,21.2V0z"></path>
            <rect width="6" height="21.2"></rect>
            <rect x="11.5" width="6" height="21.2"></rect>
          </svg>
        </div>
        <div class="next" @click="next" v-if="list.type!='podcast'">
          <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="17.42" height="20" x="0px" y="0px" viewBox="0 0 10.2 11.7" style="enable-background:new 0 0 10.2 11.7;" xml:space="preserve">
            <polygon points="0,11.7 8.8,6.4 8.8,11.7 10.2,11.7 10.2,0 8.8,0 8.8,5.6 0,0"></polygon>
          </svg>
        </div>
        <div class="shuffle" @click="enableRandomList" v-if="list.type!='podcast'">
          <div v-if="shuffle">
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0px" y="0px"
            viewBox="0 0 22 22" style="enable-background:new 0 0 22 22;" xml:space="preserve">
              <path d="M18.2,13.2c-0.1-0.1-0.4-0.1-0.5,0c-0.1,0.1-0.1,0.4,0,0.5l2.1,2h-3.6c-0.9,0-2.1-0.6-2.7-1.3L10.9,11l2.7-3.4
              c0.6-0.7,1.8-1.3,2.7-1.3h3.6l-2.1,2c-0.1,0.1-0.1,0.4,0,0.5c0.1,0.1,0.2,0.1,0.3,0.1c0.1,0,0.2,0,0.3-0.1L21,6.2
              c0.1-0.1,0.1-0.2,0.1-0.3c0-0.1,0-0.2-0.1-0.3L18.2,3c-0.1-0.1-0.4-0.1-0.5,0c-0.1,0.1-0.1,0.4,0,0.5l2.1,2h-3.6
              c-1.1,0-2.5,0.7-3.2,1.6l-2.6,3.3L7.8,7.1C7.1,6.2,5.7,5.5,4.6,5.5H1.3c-0.2,0-0.4,0.2-0.4,0.4c0,0.2,0.2,0.4,0.4,0.4h3.3
              c0.9,0,2.1,0.6,2.7,1.3L9.9,11l-2.7,3.4c-0.6,0.7-1.8,1.3-2.7,1.3H1.3c-0.2,0-0.4,0.2-0.4,0.4c0,0.2,0.2,0.4,0.4,0.4h3.3
              c1.1,0,2.5-0.7,3.2-1.6l2.6-3.3l2.6,3.3c0.7,0.9,2.1,1.6,3.2,1.6h3.6l-2.1,2c-0.1,0.1-0.1,0.4,0,0.5c0.1,0.1,0.2,0.1,0.3,0.1
              c0.1,0,0.2,0,0.3-0.1l2.7-2.7c0.1-0.1,0.1-0.2,0.1-0.3c0-0.1,0-0.2-0.1-0.3L18.2,13.2z"/>
            </svg>
          </div>
          <div v-else>
            <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20" height="20" x="0px" y="0px"
            viewBox="0 0 22 22" style="enable-background:new 0 0 22 22;" xml:space="preserve">
              <path d="M19,15.4H3.2l2.8-2.7c0.1-0.1,0.1-0.3,0-0.5c-0.1-0.1-0.3-0.1-0.5,0l-3.3,3.3C2.1,15.5,2,15.6,2,15.7c0,0.1,0,0.2,0.1,0.2
              l3.3,3.3c0.1,0.1,0.1,0.1,0.2,0.1c0.1,0,0.2,0,0.2-0.1c0.1-0.1,0.1-0.3,0-0.5L3.2,16H19c0.2,0,0.3-0.1,0.3-0.3
              C19.3,15.5,19.1,15.4,19,15.4z M20.3,7.2l-3.3-3.3c-0.1-0.1-0.3-0.1-0.5,0c-0.1,0.1-0.1,0.3,0,0.5l2.8,2.7H3.5
              c-0.2,0-0.3,0.1-0.3,0.3c0,0.2,0.1,0.3,0.3,0.3h15.8l-2.8,2.7c-0.1,0.1-0.1,0.3,0,0.5c0.1,0.1,0.1,0.1,0.2,0.1c0.1,0,0.2,0,0.2-0.1
              l3.3-3.3c0.1-0.1,0.1-0.1,0.1-0.2C20.4,7.3,20.3,7.3,20.3,7.2z"/>
            </svg>
          </div>
        </div>
        <div class="sr_speedRate" :class="this.mediaPlayer.getPlaybackRate() != 1 ? 'active' : '' " @click="setSpeedRate" v-if="list.type=='podcast' && classes.hideSpeedRateButton==false"><div>{{this.mediaPlayer.getPlaybackRate()}}X</div></div>
      </div>
   
      <div class="wavesurfer">
        <div class="timing">
            <div class="time timing_currentTime">{{ currentTime }}</div>
            <div class="time timing_totalTime">{{ totalTime }}</div>
        </div>
        <div class="wave-custom">
          <div class="wave-base">
            
          </div>
          <div class="wave-cut" :style=" css.wavecut ">
            <div class="wave-progress">
            
            </div>
          </div>
        </div>
        <div class="wave-progress-bar">
          <div class="bar progress_totalTime" :style=" css.waveColor "></div>
          <div class="bar progress_currentTime" :style=" css.progressColor "></div>
          <div class="skip" @mouseup="skipTo"></div>
        </div>
        <div class="volume" v-if="!isSafari">
          <div class="icon" @click="muteTrigger">
            <div v-if="mute">
              <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22" height="22" x="0px" y="0px"
                  viewBox="0 0 22 22" style="enable-background:new 0 0 22 22;" xml:space="preserve">
                <path d="M11.7,19c0,0.3-0.1,0.6-0.3,0.8c-0.2,0.2-0.5,0.3-0.8,0.3c-0.3,0-0.6-0.1-0.8-0.3l-4.1-4.1H1.1c-0.3,0-0.6-0.1-0.8-0.3
                  C0.1,15.2,0,14.9,0,14.6V8c0-0.3,0.1-0.6,0.3-0.8C0.5,7,0.8,6.9,1.1,6.9h4.7l4.1-4.1c0.2-0.2,0.5-0.3,0.8-0.3c0.3,0,0.6,0.1,0.8,0.3
                  c0.2,0.2,0.3,0.5,0.3,0.8V19z"/>
                <g>
                  <path d="M17.2,11.2l1.7,1.7c0.1,0.1,0.1,0.2,0.1,0.4c0,0.1,0,0.3-0.1,0.4L18.5,14c-0.1,0.1-0.2,0.1-0.4,0.1c-0.1,0-0.3,0-0.4-0.1
                    l-1.7-1.7L14.4,14c-0.1,0.1-0.2,0.1-0.4,0.1c-0.1,0-0.3,0-0.4-0.1l-0.4-0.4c-0.1-0.1-0.1-0.2-0.1-0.4c0-0.1,0-0.3,0.1-0.4l1.7-1.7
                    l-1.7-1.7c-0.1-0.1-0.1-0.2-0.1-0.4c0-0.1,0-0.3,0.1-0.4l0.4-0.4c0.1-0.1,0.2-0.1,0.4-0.1c0.1,0,0.3,0,0.4,0.1l1.7,1.7l1.7-1.7
                    c0.1-0.1,0.2-0.1,0.4-0.1c0.1,0,0.3,0,0.4,0.1l0.4,0.4C18.9,8.9,19,9.1,19,9.2c0,0.1,0,0.3-0.1,0.4L17.2,11.2z"/>
                </g>
              </svg>
            </div>
            <div v-else >
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22" height="22" x="0px" y="0px"
                viewBox="0 0 22 22" style="enable-background:new 0 0 22 22;" xml:space="preserve">
                <g>
                  <path d="M11.7,19c0,0.3-0.1,0.6-0.3,0.8c-0.2,0.2-0.5,0.3-0.8,0.3c-0.3,0-0.6-0.1-0.8-0.3l-4.1-4.1H1.1c-0.3,0-0.6-0.1-0.8-0.3
                    C0.1,15.2,0,14.9,0,14.6V8c0-0.3,0.1-0.6,0.3-0.8C0.5,7,0.8,6.9,1.1,6.9h4.7l4.1-4.1c0.2-0.2,0.5-0.3,0.8-0.3
                    c0.3,0,0.6,0.1,0.8,0.3c0.2,0.2,0.3,0.5,0.3,0.8V19z M17.1,9.2c-0.4-0.7-0.9-1.2-1.6-1.6c-0.3-0.2-0.7-0.3-1.1-0.2
                    C14,7.5,13.7,7.7,13.5,8c-0.2,0.4-0.3,0.7-0.2,1.1c0.1,0.4,0.3,0.7,0.7,0.9c0.5,0.3,0.7,0.7,0.7,1.2c0,0.5-0.2,0.9-0.6,1.2
                    c-0.3,0.2-0.5,0.6-0.6,1s0,0.8,0.3,1.1c0.2,0.3,0.5,0.5,0.9,0.6c0.4,0.1,0.8,0,1.1-0.2c0.6-0.4,1-1,1.4-1.6c0.3-0.6,0.5-1.3,0.5-2
                    C17.6,10.6,17.4,9.8,17.1,9.2z M20.9,7c-0.8-1.3-1.8-2.4-3.1-3.2c-0.3-0.2-0.7-0.3-1.1-0.2c-0.4,0.1-0.7,0.3-0.9,0.7
                    c-0.2,0.4-0.3,0.7-0.2,1.1c0.1,0.4,0.3,0.7,0.7,0.9c0.9,0.5,1.5,1.2,2,2.1c0.5,0.9,0.8,1.8,0.8,2.9c0,0.9-0.2,1.8-0.7,2.7
                    c-0.4,0.9-1.1,1.6-1.9,2.1c-0.3,0.2-0.5,0.6-0.6,1c-0.1,0.4,0,0.8,0.3,1.1c0.3,0.4,0.7,0.6,1.2,0.6c0.3,0,0.6-0.1,0.8-0.3
                    c1.2-0.8,2.1-1.9,2.8-3.2c0.7-1.3,1-2.6,1-4.1C22,9.8,21.6,8.3,20.9,7z"/>
                </g>
                </svg>
            </div>

          </div>
          <div class="slider-container">
            <div class="slide"></div>
          </div>
        </div>
      </div>
      <div class="sonaar-extend-button" @click="showCTA" v-if="list.tracks && playerCallToAction">
        <i class="fa-solid fa-ellipsis-vertical"></i>
      </div>
      <transition name="sonaar-player-storefade">
      <div class="store" v-if="list.tracks && playerCallToAction" :style="{width: storeWidth }">
        <ul class="track-store" v-if="playerCallToAction">
          <li v-for="store in playerCallToAction">
            <a :href="store.store_link" :target="store.store_link_target" v-if="list.type!='podcast'" :download=" (store.song_store_icon == 'fas fa-download')? '': false " >
              <i class="fa" :class="store.song_store_icon" v-if="store.song_store_icon != 'custom-icon'"></i>
              <div class="sr_svg-box" :data-svg-url="store.sr_icon_file" v-if="store.song_store_icon == 'custom-icon'">{{getSVG(store.sr_icon_file)}}</div>
              <span>{{store.song_store_name}}</span>
            </a>
            <a :href="store.podcast_button_link" :target="(store.podcast_button_target)?'_blank':'_self'" v-if="list.type=='podcast'">{{store.podcast_button_name}}</a>
          </li>
        </ul>
      </div>
    </transition>
    </div>
  </div>
</div>
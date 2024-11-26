/*Auto Play Or "Popup player in the footer when page loads"*/
function sr_autoPlay(){
	for (var player in IRON.playersList) {
		var that = IRON.playersList[player]

		if (that.autoplayEnable) {

			if (IRON.state.enable_ajax) {
				if (IRON.sonaar.player.playlistID == '') {//Dont load player twice
					if (!IRON.sonaar.player.wavesurfer || (!IRON.sonaar.player.wavesurfer.isPlaying() && !IRON.sonaar.player.userPref.pause)) {
						IRON.sonaar.player.setPlaylist(that.audioPlayer, 0)
					}
				}

			} else {
				if (!that.wavesurfer.isPlaying()) {
					that.triggerPlay(that.wavesurfer, that.audioPlayer)
				}
			}
		}
	}
}
sr_autoPlay();

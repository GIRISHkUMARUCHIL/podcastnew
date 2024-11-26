var app = new Vue({
  el: '#validate_licence',
  data: {
    message: {
      display:false,
      type:'',
      data:''
    },
    licenceKey: sonaarlicence.licence || ''
  },
  methods:{
    validate_licence: function(e){
      e.preventDefault();
    
      var button = e.target;
    
      if (!this.licenceKey) {
        this.outputMessage();
        return;
      }
    
      // Add loading class to button
      button.classList.add('loading');
    
      jQuery.post(
        ajaxurl,
        {
          action: 'sonaar_activateRemoteLicence',
          data: {
            siteUrl: window.location.protocol + '//' + window.location.hostname,
            licenceKey: this.licenceKey
          }
        },
        function(data, textStatus, xhr) {
          // Remove loading class from button
          button.classList.remove('loading');
    
          if ('success' == textStatus) {
            var response = JSON.parse(data.body);
            console.dir(response);
            switch (response.success) {
              case true:
                this.register_licence(response);
                break;
              case false:
                this.errorMessage(response.error);
                break;
              default:
                this.outputMessage("error", "<h3 class='error'>Sorry</h3>The key does not seem to match with a valid license key for Sonaar.");
            }
          }
        }.bind(this)
      );
    },
    register_licence: function( response ){
      jQuery.post(
        ajaxurl,
        {
          action: 'sonaar_registerLicence',
          data: {
            'licenceKey': this.licenceKey,
            'response': response
          }
        },
        function( data, textStatus){
          this.outputMessage("succes","<h3 class='success'>Success!</h3><br>Your license key is valid. <strong>Last Step (if you've not already done so):</strong> <a href='tools.php?page=fw-backups-demo-content'>Import a theme demo </a>and start customizing your website.")

        }.bind(this))
    },
    clearCache: function(type, e ){
      e.preventDefault()
      jQuery.post(
        ajaxurl,
        {
          action: 'sonaar_clearCache',
          data: {
            'type': type,
          }
        },
        function( data, textStatus){
          this.outputMessage("succes","<h3 class='success'>Done</h3> The "+ type +"s has been cleared.")
        }.bind(this))
    },

    errorMessage: function(error){
      switch (error) {
        case 'expired':
          this.outputMessage("error","<h3 class='error'>Sorry</h3>Your license key has expired. Login to your account at <a href='https://sonaar.io/login' target='_blank'>https://sonaar.io/login</a> and renew your subscription.")
          break;

        case 'revoked':
          this.outputMessage("error","<h3 class='error'>Sorry</h3>Your license key has been revoked.")
          break;

        case 'no_activations_left':
          this.outputMessage("error","<h3 class='error'>Sorry</h3>Your license key is valid but you’ve activated it too many times on another domain(s).  Login to your account at <a href='https://sonaar.io/login' target='_blank'>https://sonaar.io/login</a> and manage your activation domains.")
          break;
        default:
          this.outputMessage("error","<h3 class='error'>Sorry</h3>The key does not seem to match with a valid license key for Sonaar.")
      }

    },
    outputMessage: function(type, message){
      this.message.display = true
      this.message.data = message
      this.message.type = type
    },
    closeMessage:function(){
      this.message.display = false
    }
  }
})
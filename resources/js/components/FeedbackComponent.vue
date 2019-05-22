<template>
  <form id="form-contact" :model="feedbackForm" class="clearfix ts-form ts-form-email">
    <div class="row">
      <div class="col-md-6 col-sm-6">
        <div class="form-group">
          <label for="form-contact-name">Name *</label>
          <input type="text" class="form-control" id="form-contact-name" v-model="feedbackForm.nickname" placeholder="Name" required>
        </div>
      </div>
      <div class="col-md-6 col-sm-6">
        <div class="form-group">
          <label for="form-contact-email">Email *</label>
          <input type="email" class="form-control" id="form-contact-email" v-model="feedbackForm.email" placeholder="Email" required>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <label for="form-contact-message">Message *</label>
          <textarea class="form-control" id="form-contact-message" rows="5" v-model="feedbackForm.content" placeholder="Message" required></textarea>
        </div>
      </div>
    </div>
    <div class="form-group clearfix">
      <button @click="submitGuestFeedback" type="button" class="btn btn-primary float-right ts-btn-arrow">SUBMIT</button>
    </div>
    <div class="form-contact-status"></div>
  </form>
</template>

<script>
  export default {
    name: "Feedback",
    components: {},
    data () {
      return {
        feedbackForm: {
          nickname: '',
          email: '',
          content: '',
        },
        verifyCodeBase64: '',
        verifyCodeKey: ''
      }
    },
    mounted() {
      // this.getVerifyCodeBase64()
    },
    methods: {
      submitGuestFeedback() {
        if (!this.feedbackForm.nickname) {
          return false
        }
        if (!this.feedbackForm.email) {
          return false
        }
        if (!this.feedbackForm.content) {
          console.log('content null')
          return false
        }
        return false
        window.axios.post('/api/open/feedback', this.feedbackForm).then((response) => {
          console.log(response)
          this.feedbackForm.nickname = ''
          this.feedbackForm.email = ''
          this.feedbackForm.content = ''
        }).catch((error) => {
          console.error(error)
        })
      },
      getVerifyCodeBase64(config) {
        var style = ''
        if (config) {
          style = config
        }
        window.axios.get('/captcha/api/'+style).then((response)=>{
          this.verifyCodeBase64 = response.img
          this.verifyCodeKey = response.key
        }).catch((error)=>{
          console.error(error)
        })
      }
    }
  }
</script>

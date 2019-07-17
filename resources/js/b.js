require('./bootstrap');
require('./olr/prism.js');
window.ElementUI = require('element-ui')
Vue.component('comment-component', require('./components/CommentComponent').default);
const b = new Vue({
  el: '#b',
});

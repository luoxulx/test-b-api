require('./bootstrap');
require('./olr/prism.js');
import Element from 'element-ui';
Vue.use(Element, { size: 'small', zIndex: 3000 });
Vue.component('verify', require('./components/Verify/index').default);
Vue.component('comment-component', require('./components/CommentComponent').default);
const b = new Vue({
  el: '#b',
});

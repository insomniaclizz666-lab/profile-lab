// resources/js/bootstrap.js
// Bootstrap module — load global libraries here (e.g. Axios CSRF setup).

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

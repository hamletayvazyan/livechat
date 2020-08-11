import axios from 'axios'
import {api_point} from "../environments"

export const AuthService = {
    login: function (formData, $store){
        return axios.post(`${api_point}/login`, formData).then(resp => {
            console.log(resp);
            this.fillStorageValuesAndAuthVariable(resp.data, $store);
            this.updateAuthorizationBearerToken(`Bearer ${resp.data.token}`);
            return resp.data;
        })
    },
    register: function (formData, $store){
        return axios.post(`${api_point}/register`, formData).then(resp => {
            this.fillStorageValuesAndAuthVariable(resp.data, $store);
            this.updateAuthorizationBearerToken(`Bearer ${resp.data.token}`);
            return resp.data;
        })
    },
    logOut($store) {
        this.clearStorageAndResetAuthVariable($store);
        return axios.post(`${api_point}/logoutApi`)
            .then((resp) => {
                this.updateAuthorizationBearerToken(null);
                return resp.data
            })
            .catch()
            .finally()
    },
    fillStorageValuesAndAuthVariable(data,$store) {
        localStorage.setItem('token', data.token);
        localStorage.setItem('user', JSON.stringify(data.user_info));
        $store.commit('checkAuth');
        $store.commit('userDetails');
    },
    clearStorageAndResetAuthVariable($store) {
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        $store.commit('userDetails');
        $store.commit('checkAuth');
    },
    updateAuthorizationBearerToken(token) {
        window.axios.defaults.headers.common['Authorization'] = token;
    }
}

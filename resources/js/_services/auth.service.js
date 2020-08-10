import {api_point} from "../environments";

export const AuthService = {
    login: function (formData){
        return axios.post(`${api_point}/login`, formData).then(resp => {
            console.log(resp);
            return resp.data;
        })
    },
    register: function (formData){
        return axios.post(`${api_point}/register`, formData).then(resp => {
            console.log(resp);
        })
    }
}

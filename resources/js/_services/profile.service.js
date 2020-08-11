import axios from 'axios'
import {api_point} from "../environments"

export const ProfileService = {
    users: function (){
        return axios.get(`${api_point}/users`).then(resp => {
            return resp.data;
        })
    },
    user: function (){
        return axios.get(`${api_point}/user`).then(resp => {
            return resp.data;
        })
    }
}

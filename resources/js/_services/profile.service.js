import axios from 'axios'
import {api_point} from "../environments"

export const ProfileService = {
    users: function ($store){
        axios.get(`${api_point}/users`).then(resp => {
            console.log(resp.data);
        })
    },
    user: function ($store){
        axios.get(`${api_point}/user`).then(resp => {
            console.log(resp.data);
        })
    }
}

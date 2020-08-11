import axios from 'axios'
import {api_point} from "../environments"

export const ChatService = {
    getChat(params){
        return axios.post(`${api_point}/chat`, params).then(resp => {
            return resp.data;
        })
    },
    sendMessage(params){
        return axios.post(`${api_point}/send`, params).then(resp => {
            return resp.data;
        })
    }
}

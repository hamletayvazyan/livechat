import axios from 'axios'
import {api_point} from "../environments"

export const ChatService = {
    getChat(params){
        return axios.post(`${api_point}/chat`, params).then(resp => {
            return resp.data;
        })
    },
    getChatNew(){
        return axios.get(`${api_point}/chats`).then(resp => {
            return resp.data;
        })
    },
    getMessages(chatId){
        return axios.get(`${api_point}/chats/${chatId}/messages`).then(resp => {
            return resp.data;
        })
    },
    sendMessage(params){
        return axios.post(`${api_point}/send`, params).then(resp => {
            return resp.data;
        })
    },
    sendMessageNew(params, chatId){
        return axios.post(`${api_point}/chats/${chatId}/messages`, {text: params}).then(resp => {
            return resp.data;
        })
    }
};

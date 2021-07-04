// export const api_point = 'http://127.0.0.1:8000/api';
export const api_point = `${window.location.origin}/api`;
// export const api_point = 'http://192.168.1.32:8000/api';

export const api_token = localStorage.getItem('token');

export const authenticated = !!api_token;

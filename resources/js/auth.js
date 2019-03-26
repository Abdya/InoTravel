import Axios from "axios";

class Auth {
    constructor() {
        if (window.localStorage.getItem('token')) {
            this.token = window.localStorage.getItem('token');
            Axios.defaults.headers.common['Authorization'] = 'Bearer ' + this.token;
        }
        
        this.user = null;
    }

    login(token, user) {
        window.localStorage.setItem('token', token);
        window.localStorage.setItem('user', JSON.stringify(user));

        Axios.defaults.headers.common['Authorization'] = 'Bearer ' + token;

        this.token = token;
        this.user = user;

        Event.$emit('userLoggedIn');
    }

    check() {
        return !! this.token;
    }
}

export default new Auth();
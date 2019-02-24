import {EventEmitter, Injectable} from '@angular/core';
import {environment} from '../../environments/environment';
import {HttpClient} from '@angular/common/http';
import {unescape} from "querystring";

@Injectable({
    providedIn: "root"
})
export class UserService {
    protected _isAdmin = false;
    protected _displayName = '';
    protected _id = undefined;
    protected _sid = undefined;
    protected _login = '';

    constructor(private httpClient: HttpClient) {
        this.clean();
    }

    public clean() {
        this._isAdmin = false;
        this._displayName = 'Гость';
        this._id = undefined;
        this._sid = undefined;
        this._login = undefined;
    }

    get isLogined() {
        return !!this._sid;
    }

    get isAdmin() {
        return this._isAdmin === true;
    }

    public login(login: string, pass: string) {
        const uri = environment.apiUrl + '/auth/login';
        const ee = new EventEmitter<any>();
        const observableLogin = this.httpClient.get(uri, {
            params: {
                login: login,
                pass: pass
            }
        });
        observableLogin.subscribe((json: JsonLogin) => {
            if (json.success) {
                this._id = json.data.id;
                this._sid = json.data.sid;
                this._displayName = json.data.display_name;
                this._isAdmin = json.data.is_admin;
            }
            ee.emit({
                isLogined: this.isLogined,
                message: json.message
            });
        });
        return ee;
    }

    public logout() {
        const uri = environment.apiUrl + '/auth/logout';
        const ee = new EventEmitter<any>();
        const observableLogout = this.httpClient.post(uri, {
            sid: this._sid
        });
        observableLogout.subscribe((json: JsonLogout) => {
            if (json.success) {
                this.clean();
            }
            ee.emit({
                success: json.success,
                message: json.message
            });
        });
        return ee;
    }
}

class JsonLogin {
    public success: boolean;
    public message: string;
    public data: JsonLoginData;
}

class JsonLoginData {
    public id: number;
    public sid: string;
    public login: string;
    public display_name: string;
    public is_admin: boolean;
}

class JsonLogout {
    public success: boolean;
    public message: string;
}

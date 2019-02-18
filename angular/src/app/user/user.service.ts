import {Injectable} from '@angular/core';
import {environment} from '../../environments/environment';
import {HttpClient} from '@angular/common/http';

@Injectable({
    providedIn: 'root'
})
export class UserService {
    private isLogined: boolean = false;

    constructor(private httpClient: HttpClient) {
    }

    public login(login: string, pass: string) {
        const uri = environment.apiUrl + '/auth/login';
        const observableLogin = this.httpClient.get(uri, {
            params: {
                login: login,
                pass: pass
            }
        });
        observableLogin.subscribe((json) => {
            if (json.success) {
                this.isLogined = true;
            }
        });
        return observableLogin;
    }
}

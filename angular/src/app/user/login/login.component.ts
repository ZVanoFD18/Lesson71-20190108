import {Component, OnInit} from '@angular/core';
import {FormControl, FormGroup, Validators} from '@angular/forms';
import {UserService} from '../user.service';
import {Router} from '@angular/router';

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
    public form: FormGroup;

    constructor(private us: UserService, private router: Router) {
        this.form = new FormGroup({
            login: new FormControl('', Validators.required),
            pass: new FormControl('', Validators.required)
        });
    }

    ngOnInit() {
    }

    onSubmit() {
        this.us.login(
            this.form.get('login').value,
            this.form.get('pass').value
        ).subscribe((authRes) => {
            if (authRes.message) {
                alert(authRes.message);
            }
            if (authRes.isLogined) {
                this.router.navigateByUrl('/user/profile');
            }
        });
    }
}

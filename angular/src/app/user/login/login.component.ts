import {Component, OnInit} from '@angular/core';
import {FormControl, FormGroup, Validators} from "@angular/forms";
import {UserService} from "../user.service";

@Component({
    selector: 'app-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
    public form: FormGroup;

    constructor(private us: UserService) {
        this.form = new FormGroup({
            login : new FormControl('', Validators.required),
            pass : new FormControl('', Validators.required)
        });
    }

    ngOnInit() {
    }
    onSubmit(){
        alert('submit');
        this.us.login(
            this.form.get('login').value,
            this.form.get('pass').value
        ).subscribe((isLogined) => {
        });
    }
}

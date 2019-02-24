import {Component, OnInit} from '@angular/core';
import {Router} from '@angular/router';
import {FormControl, FormGroup, Validators} from '@angular/forms';

import {UserService} from '../user.service';

@Component({
    selector: 'app-register',
    templateUrl: './register.component.html',
    styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
    public form: FormGroup;

    constructor(private us: UserService, private router: Router) {
        this.form = new FormGroup({
            login: new FormControl(null,  Validators.compose([
                Validators.required,
                Validators.pattern('[a-zA-Z]+[a-zA-Z\d]{3,14}')
            ])),
            displayName: new FormControl('', [
                Validators.required,
                Validators.pattern('[a-zA-Z]+[a-zA-Z\d]{3,14}')
            ]),
            pass: new FormGroup({
                userPass: new FormControl('', Validators.required),
                userPassConfirm: new FormControl('', [
                    Validators.required,
                    this.passConfirmValidator.bind(this)
                ])
            })
        });
    }

    ngOnInit() {
    }
    // get myField() {
    //     return this.form.controls;
    // }

    passConfirmValidator(passConfirm: FormControl) {
        if (!this.form) {
            return null;
        }
        if (this.form.get('pass').get('userPass').value === this.form.get('pass').get('userPassConfirm').value) {
            return null;
        }
        return {
            passConfirmNotSame: true
        };
    }

    onSubmit() {
        alert('submit');
    }
}

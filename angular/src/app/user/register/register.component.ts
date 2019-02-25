import {Component, OnInit} from '@angular/core';
import {Router} from '@angular/router';
import {FormControl, FormGroup, Validators} from '@angular/forms';

import {JsonRegister, RegisterParams, UserService} from '../user.service';

@Component({
    selector: 'app-register',
    templateUrl: './register.component.html',
    styleUrls: ['./register.component.css']
})
export class RegisterComponent implements OnInit {
    public form: FormGroup;

    constructor(private us: UserService, private router: Router) {
        this.form = new FormGroup({
            login: new FormControl(null, Validators.compose([
                Validators.required,
                Validators.pattern('[a-zA-Z]+[a-zA-Z0-9_]{3,14}')
            ])),
            displayName: new FormControl('', [
                Validators.required
            ]),
            pass: new FormGroup({
                userPass: new FormControl('', [
                    Validators.required,
                    Validators.pattern('[a-zA-Z0-9_]{3,14}')
                ]),
                userPassConfirm: new FormControl('', [
                    Validators.required,
                    this.validatorPassConfirm.bind(this)
                ])
            })
        });
    }

    ngOnInit() {
    }

    // get myField() {
    //     return this.form.controls;
    // }
    validatorPassConfirm(passConfirm: FormControl) {
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
        const params = new RegisterParams();
        params.login = this.form.controls.login.value;
        params.pass = this.form.controls.pass.controls.userPass.value;
        params.display_name = this.form.controls.displayName.value;
        this.us.register(params).subscribe((result: JsonRegister) => {
            if (!result.success) {
                return alert(result.message || 'Неизвестная ошибка!');
            }
            alert('Регистрация успешно завершена');
            this.router.navigateByUrl('/user/login');
        });
    }

    onCancelClick() {
        this.router.navigateByUrl('');
    }
}

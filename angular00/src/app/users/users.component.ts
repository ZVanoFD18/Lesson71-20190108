import {Component, OnInit} from '@angular/core';
import {FormControl, FormGroup, NgForm, Validator, Validators} from '@angular/forms';

@Component({
    selector: 'app-users',
    templateUrl: './users.component.html',
    styleUrls: ['./users.component.css']
})
export class UsersComponent implements OnInit {
// private formUserAdd: FormGroup;
    private formUserEdit: FormGroup;

    constructor() {
        this.formUserEdit = new FormGroup({
            'login': new FormControl('aaa'),
            'email': new FormControl('', [
                Validators.required,
                Validators.email
            ])
        });
    }

    ngOnInit() {
    }

    onFormUserAddSubmit(form: NgForm) {
        alert('add/submit');
        console.log(arguments);
    }
    onFormUserEditSubmit(form: NgForm) {
        alert('edit/submit');
        console.log(arguments);
    }

}

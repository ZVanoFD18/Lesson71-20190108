import {Component, OnInit} from '@angular/core';
import {UserService} from '../user.service';
import {Router} from "@angular/router";

@Component({
    selector: 'app-logout',
    templateUrl: './logout.component.html',
    styleUrls: ['./logout.component.css']
})
export class LogoutComponent implements OnInit {

    constructor(private us: UserService, private router: Router) {
    }

    ngOnInit() {
    }

    onLogoutClick() {
        this.us.logout().subscribe((result) => {
            if (result.message) {
                alert(result.message);
            }
            if (result.success){
                this.router.navigateByUrl('');
            }
        });
    }
}

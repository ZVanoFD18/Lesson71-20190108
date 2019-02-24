import { Injectable } from '@angular/core';
import { CanActivate, ActivatedRouteSnapshot, RouterStateSnapshot } from '@angular/router';
import { Observable } from 'rxjs';
import {UserService} from "../user/user.service";

@Injectable({
  providedIn: 'root'
})
export class AdminGuard implements CanActivate {
    constructor(private us: UserService) {
    }
  canActivate(
    next: ActivatedRouteSnapshot,
    state: RouterStateSnapshot): Observable<boolean> | Promise<boolean> | boolean {
      if (!this.us.isLogined) {
          return false;
      }
      if (!this.us.isAdmin) {
          return false;
      }
      return true;
  }
}

import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {Routes, RouterModule} from '@angular/router';

import {PageComponent} from "./page/page.component";
import {HomeComponent} from "./home/home.component";
import {AboutComponent} from "./about/about.component";
import {UsersComponent} from "./users/users.component";

import {LoginComponent as UserLoginComponent} from "./user/login/login.component";
import {LogoutComponent as UserLogoutComponent} from "./user/logout/logout.component";

const routes: Routes = [{
    path: '',
    component: HomeComponent
}, {
    path: 'home',
    component: HomeComponent
}, {
    path: 'about',
    component: AboutComponent
}, {
    path: 'page',
    component: PageComponent
}, {
    path: 'users',
    component: UsersComponent
}, {
    path: 'user/login',
    component: UserLoginComponent
}, {
    path: 'user/logout',
    component: UserLogoutComponent
}];

@NgModule({
  declarations: [],
  imports: [
    CommonModule,
    RouterModule.forRoot(routes)
  ],
  exports: [ RouterModule ]
})
export class AppRoutingModule { }

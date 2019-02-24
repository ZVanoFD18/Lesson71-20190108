import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import {Routes, RouterModule} from '@angular/router';

import {PageComponent} from './page/page.component';
import {HomeComponent} from './home/home.component';
import {AboutComponent} from './about/about.component';

import {UsersComponent as AdminUsersComponent} from './admin/users/users.component';
import {LoginComponent as UserLoginComponent} from './user/login/login.component';
import {RegisterComponent as UserRegisterComponent} from './user/register/register.component';
import {LogoutComponent as UserLogoutComponent} from './user/logout/logout.component';
import {ProfileComponent as UserProfileComponent} from './user/profile/profile.component';
import {ProfileGuard as UserProfileGuard} from './user/profile/profile.guard';
import {AdminGuard} from './admin/admin.guard';

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
    path: 'admin/users',
    component: AdminUsersComponent,
    canActivate : [AdminGuard]
}, {
    path: 'user/login',
    component: UserLoginComponent
}, {
    path: 'user/register',
    component: UserRegisterComponent
}, {
    path: 'user/logout',
    component: UserLogoutComponent
}, {
    path: 'user/profile',
    component: UserProfileComponent,
    canActivate : [UserProfileGuard]
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

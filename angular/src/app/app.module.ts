import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';
import {HttpClientModule} from '@angular/common/http';

import {AppComponent} from './app.component';
import {MenuComponent} from './menu/menu.component';
import {HomeComponent} from './home/home.component';
import {PageComponent} from './page/page.component';
import {AboutComponent} from './about/about.component';
// import {Routes, RouterModule} from '@angular/router';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {UsersComponent} from './users/users.component';
import { LogoComponent } from './logo/logo.component';
import { FooterComponent } from './footer/footer.component';
import { RegisterComponent } from './user/register/register.component';
import { LoginComponent as UserLoginComponent } from './user/login/login.component';
import {UserService} from './user/user.service';
import { LogoutComponent as UserLogoutComponent } from './user/logout/logout.component';
import { AppRoutingModule } from './app-routing.module';

@NgModule({
    declarations: [
        AppComponent,
        MenuComponent,
        HomeComponent,
        PageComponent,
        AboutComponent,
        UsersComponent,
        LogoComponent,
        FooterComponent,
        RegisterComponent,
        UserLoginComponent,
        UserLogoutComponent
    ],
    imports: [
        BrowserModule,
        FormsModule,
        ReactiveFormsModule,
        HttpClientModule,
        AppRoutingModule
    ],
    providers: [
        UserService
    ],
    bootstrap: [AppComponent]
})
export class AppModule {
}

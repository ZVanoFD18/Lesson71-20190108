import {BrowserModule} from '@angular/platform-browser';
import {NgModule} from '@angular/core';

import {AppComponent} from './app.component';
import {MenuComponent} from './menu/menu.component';
import {HomeComponent} from './home/home.component';
import {PageComponent} from './page/page.component';
import {AboutComponent} from './about/about.component';
import {Routes, RouterModule} from '@angular/router';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {UsersComponent} from './users/users.component';
import { LogoComponent } from './logo/logo.component';
import { FooterComponent } from './footer/footer.component';

const appRoutes = [{
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
}];

@NgModule({
    declarations: [
        AppComponent,
        MenuComponent,
        HomeComponent,
        PageComponent,
        AboutComponent,
        UsersComponent,
        LogoComponent,
        FooterComponent
    ],
    imports: [
        BrowserModule,
        RouterModule.forRoot(appRoutes),
        FormsModule,
        ReactiveFormsModule
    ],
    providers: [],
    bootstrap: [AppComponent]
})
export class AppModule {
}

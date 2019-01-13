import {Component, OnInit} from '@angular/core';
import {DomSanitizer} from '@angular/platform-browser';
import { FormsModule} from '@angular/forms';
@Component({
    selector: 'app-page',
    templateUrl: './page.component.html',
    styleUrls: ['./page.component.css']
})
export class PageComponent implements OnInit {
    title = 'anguar00 11123';
    userName = 'vasya';
    ifrSrc: any;
    ifrWidth = 1024;

    constructor(private sanitizer: DomSanitizer) {
    }

    ngOnInit() {
        const url = 'http://meta.ua';
        this.ifrSrc = this.sanitizer.bypassSecurityTrustResourceUrl(url);
    }

    getTitle() {
        return this.title;
    }

    onButtonClick1() {
        alert('onButtonClick');
    }

}

import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-logo',
  templateUrl: './logo.component.html',
  styleUrls: ['./logo.component.css']
})
export class LogoComponent implements OnInit {
  private LOGO = require('./assets/logo.svg');
  constructor() { }

  ngOnInit() {
  }

}

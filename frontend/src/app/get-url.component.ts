import { Component, Input, OnInit } from '@angular/core';

import { UrlService }               from './services/url.service';

@Component({
  selector: 'get-url',
  template: `
    <div class="row center">
      <div>
        <input [class.error]="inputError" class="left" type="text" placeholder="example: https://github.com/" #url/>
        <button (click)="compress(url.value)">Go!</button>
        <input class="right" type="text" readonly="true">
      </div>
    </div>
  `,
  styleUrls: ['get-url.component.css']
})
export class GetUrlComponent implements OnInit {
  inputError: boolean;

  constructor(private urlService: UrlService) {}

  ngOnInit():void {}

  compress(url: string):void {
    this.inputError = false;

    if (!this.isUrlValid(url)) {
      this.inputError = true;
      return;
    }

    let data = this.urlService.getHeroes(url);
    console.log(data);
  }

  private isUrlValid(url: string) {
      let pattern = /^((https|http):\/\/)([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/i;
      return Boolean (pattern.exec(url));
  }
}

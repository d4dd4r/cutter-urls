import { NgModule }           from '@angular/core';
import { BrowserModule }      from '@angular/platform-browser';
import { FormsModule }        from '@angular/forms';
import { HttpModule }         from '@angular/http';

import { AppComponent }       from './app.component';
import { GetUrlComponent }    from './get-url.component'


import { UrlService }         from './services/url.service';
import { AppRoutingModule }   from './app-routing.module';

@NgModule({
  declarations: [
    AppComponent,
    GetUrlComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    HttpModule
  ],
  providers: [UrlService],
  bootstrap: [AppComponent]
})
export class AppModule { }

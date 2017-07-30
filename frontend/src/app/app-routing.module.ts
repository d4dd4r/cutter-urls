import { NgModule }             from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

import { GetUrlComponent }      from './get-url.component';

const routes: Routes = [
  { path: '', redirectTo: '/main', pathMatch: 'full' },
  { path: 'main',  component: GetUrlComponent }
];

@NgModule({
  imports: [ RouterModule.forRoot(routes) ],
  exports: [ RouterModule ]
})
export class AppRoutingModule {}

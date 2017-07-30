import { Component }  from '@angular/core';

@Component({
  selector: 'app-root',
  template: `
    <div class="header">
      <h1>{{title}}</h1>
      <nav>
        <a routerLink="/main">main</a>
        <a routerLink="/info">info</a>
      </nav>
    </div>
    <router-outlet></router-outlet>
  `,
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'Cutter-Url';
}

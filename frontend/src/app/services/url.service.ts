import { Injectable }    from '@angular/core';
import { Headers, Http, Response } from '@angular/http';

import { Observable } from 'rxjs/Rx';

import 'rxjs/add/operator/toPromise';

@Injectable()
export class UrlService {
  private api = 'http://127.0.0.1:8000/api';
  private headers = new Headers({
    'Content-Type': 'application/json',
    'Access-Control-Allow-Origin': '*'
  });

  constructor(private http: Http) {}

  getHeroes(url: string): Observable < any > {
    return this.http.post(`${this.api}/test`, url)
      .map((res: Response) => res.json())
      .catch((error: any) => Observable.throw(error.json().error || 'Server error'));
      // .toPromise()
      // .then(response => response.json().data as any)
      // .catch(this.handleError);
  }

  private handleError(error: any): Promise < any > {
    console.error('An error occurred', error);
    return Promise.reject(error.message || error);
  }
}

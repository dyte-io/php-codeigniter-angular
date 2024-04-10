import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { lastValueFrom } from 'rxjs';

@Injectable({
  providedIn: 'root',
})
export class DyteService {
  constructor(private http: HttpClient) {}

  async createMeeting(title: string) {
    return lastValueFrom(
      this.http.post(
        'http://localhost:8080/meeting',
        {
          title,
        },
        {
          headers: {
            'Content-Type': 'application/json',
          },
        }
      )
    );
  }
  addParticipant(name: string, email: string, meetingId: string) {
    return lastValueFrom(
      this.http.post(
        'http://localhost:8080/participant',
        {
          name,
          email,
          meetingId,
        },
        {
          headers: {
            'Content-Type': 'application/json',
          },
        }
      )
    );
  }
}

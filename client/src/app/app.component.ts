import { NgFor, NgIf } from '@angular/common';
import { Component, ViewChild } from '@angular/core';
import { DyteClock, DyteMeeting } from '@dytesdk/angular-ui-kit';
import DyteClient from '@dytesdk/web-core';
import { DyteService } from './dyte.service';

type CallType = 'audio' | 'video';

type MicState = 'Mute' | 'Unmute';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css'],
})
export class AppComponent {
  title = 'default-meeting-ui';

  doctors: string[] = [];

  selectedDoc?: string;

  callType?: CallType;

  meeting: DyteClient | undefined = undefined;

  micText: MicState = 'Unmute';

  @ViewChild('meeting') $meetingEl!: DyteMeeting;

  @ViewChild('clock') $clockEl!: DyteClock;

  constructor(private dyteService: DyteService) {}

  async ngAfterViewInit() {
    // fetch doctor info
    this.doctors = [
      'Meredith Grey',
      'Cristina Yang',
      'Miranda Bailey',
      'Richard Webber',
    ];
  }

  async initMeeting(doc: string, callType: CallType) {
    // create meeting with selected doc
    const meetingResponse: any = await this.dyteService.createMeeting(
      `Meeting with ${doc}`
    );
    // add participant
    const participantResponse: any = await this.dyteService.addParticipant(
      'Test',
      'test@cadtech.com',
      meetingResponse.data.id
    );
    // notify doctor here

    // start meeting
    const authToken = participantResponse.data.token;
    const meeting = await DyteClient.init({
      authToken,
      defaults: {
        audio: false,
        video: false,
      },
    });
    this.meeting = meeting;
    this.micText = meeting.self.audioEnabled ? 'Mute' : 'Unmute';
    if (callType === 'audio') {
      this.$clockEl.meeting = meeting;
      meeting.joinRoom();
    }
    this.$meetingEl.meeting = meeting;
    meeting.self.once('roomLeft', () => {
      this.reset();
    });
  }

  onSelect(doc: string, callType: CallType): void {
    this.selectedDoc = doc;
    this.callType = callType;
    this.initMeeting(doc, callType);
  }

  async onMicToggle() {
    if (this.meeting?.self.audioEnabled) {
      await this.meeting?.self.disableAudio();
      this.micText = 'Unmute';
    } else {
      this.meeting?.self.enableAudio();
      this.micText = 'Mute';
    }
  }

  async onLeave() {
    this.callType = undefined;
    this.selectedDoc = undefined;
    await this.meeting?.leaveRoom();
  }

  reset() {
    this.callType = undefined;
    this.selectedDoc = undefined;
  }
}

import { ChangeDetectorRef, Component, ViewChild } from '@angular/core';
import { MatSidenav } from '@angular/material/sidenav';
import { BreakpointObserver } from '@angular/cdk/layout';
import { AuthService } from 'src/app/providers/auth/auth.service';
import { Router } from '@angular/router';

@Component({
  selector: 'app-pages',
  templateUrl: './pages.component.html',
  styleUrls: ['./pages.component.scss']
})
export class PagesComponent {
  @ViewChild(MatSidenav)
  sidenav!: MatSidenav;

  constructor( 
    private observer: BreakpointObserver, 
    private cd: ChangeDetectorRef,
    private authService: AuthService,
    private router: Router
  ) {

  }

  ngAfterViewInit() {
    this.observer.observe(['(max-width: 800px)']).subscribe((resp: any) => {
      if(resp.matches) {
        this.sidenav.mode = 'over';
        this.sidenav.close();
      } else {
        this.sidenav.mode = 'side';
        this.sidenav.open();      
      }
    })
    this.cd.detectChanges();
  }

  logout(){
    this.authService.logout().subscribe(
      response => {
        console.log("Deslogueado");
        this.authService.deleteToken();
        this.router.navigateByUrl('/login');
      },
      error => {
        console.log("Error al desloguear");
      }
    );
  }

}

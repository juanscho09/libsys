import { Component, OnInit, ViewChild } from '@angular/core';
import { MatDialog } from '@angular/material/dialog';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { Booking } from 'src/app/models/booking/booking.model';
import { BookingService } from 'src/app/providers/booking/booking.service';
import { BookingCreateComponent } from '../booking-create/booking-create.component';
import { ModalsComponent } from '../../modals/modals.component';
import { MatSnackBar, MatSnackBarHorizontalPosition, MatSnackBarVerticalPosition } from '@angular/material/snack-bar';
import { FixedSizeVirtualScrollStrategy } from '@angular/cdk/scrolling';

@Component({
  selector: 'app-booking-list',
  templateUrl: './booking-list.component.html',
  styleUrls: ['./booking-list.component.scss']
})
export class BookingListComponent implements OnInit {
  displayedColumns = ['user_name', 'book_name', 'reservation_date', 'actions'];
  dataSource!: MatTableDataSource<Booking>;
  bookings: Booking[] = [];
  totalCount: number = 0;
  pageIndex: number = 0;
  pageSize: number = 5;
  horizontalPosition: MatSnackBarHorizontalPosition = 'center';
  verticalPosition: MatSnackBarVerticalPosition = 'top';
  durationInSeconds = 5;
  isLoading = false;
  

  @ViewChild(MatPaginator) paginator!: MatPaginator;
  @ViewChild(MatSort) sort!: MatSort;

  constructor(private bookingService:BookingService,
              private _dialog: MatDialog,
              private _snackBar: MatSnackBar
  ) {

  }

  ngOnInit(): void {
    //throw new Error('Method not implemented.');
    this.get("", "", "");
  }

  applyFilter(event: Event) {
    const filterValue = (event.target as HTMLInputElement).value;
    this.dataSource.filter = filterValue.trim().toLowerCase();

    if (this.dataSource.paginator) {
      this.dataSource.paginator.firstPage();
    }
  }
  
  handlePageEvent(e: PageEvent){
    this.pageIndex = e.pageIndex;
    this.pageSize = e.pageSize;

    //let sorting = this.getSorting(this.sortingControl.value ?? "");
    this.get("", "", "");
  }

  get(sort: string, orderby: string, search: string){
    this.isLoading = true;
    this.bookingService.getPendingReservation(sort, orderby, search, (this.pageIndex + 1), this.pageSize).subscribe(
      (response:any) => {
        this.bookings = response.body.message.data as Booking[];
        this.dataSource = new MatTableDataSource(this.bookings);
        this.dataSource.data = response.body.message.data;
        //this.dataSource._updateChangeSubscription();
        this.totalCount = response.body.message.pagination.totalRows 
          ? Number(response.body.message.pagination.totalRows) 
          : 0;
        this.isLoading = false;
      },
      (error: any) => {
        this.isLoading = false;
      });
  }

  openAddBookingForm(){
    this._dialog.open(BookingCreateComponent);
  }

  openConfirmDialog(bookingId: string): void {
    const dialogRef = this._dialog.open(ModalsComponent, {
      width: '350px',
      data: { message: '¿Estás seguro de que queres eliminar este elemento?' }
    });

    this.isLoading = true;
    dialogRef.afterClosed().subscribe(result => {
      if (result) {
        this.bookingService.delete(bookingId).subscribe(
          response => {
            console.log('borrado correctamente');
            this.openSnackBar();
            this.get("", "", "");
            this.isLoading = false;
          }, 
          error =>{
            this.isLoading = false;
            console.log('Error al borrar el elemento');
          });
        // Aquí se ejecuta la lógica para eliminar el elemento
        // Llamada a tu función de eliminación
      } else { this.isLoading = false; }
    });
  }

  openSnackBar(){
    this._snackBar.open('Se eliminó correctamente!!', 'OK', {
      horizontalPosition: this.horizontalPosition,
      verticalPosition: this.verticalPosition,
      duration: this.durationInSeconds * 3000,
    });
  }
}

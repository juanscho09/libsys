import { Component, OnInit, ViewChild } from '@angular/core';
import { FormControl } from '@angular/forms';
import { MatPaginator, PageEvent } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { Booking } from 'src/app/models/booking/booking.model';
import { BookingService } from 'src/app/providers/booking/booking.service';
import { ModalsComponent } from '../../modals/modals.component';
import { MatDialog } from '@angular/material/dialog';
import { MatSnackBar, MatSnackBarHorizontalPosition, MatSnackBarVerticalPosition } from '@angular/material/snack-bar';


@Component({
  selector: 'app-book-loan',
  templateUrl: './book-loan.component.html',
  styleUrls: ['./book-loan.component.scss']
})
export class BookLoanComponent implements OnInit {

  displayedColumns = ['user_name', 'book_name', 'borrowed_book_at', 'returned_book_at', 'actions'];
  dataSource!: MatTableDataSource<Booking>;
  filterBookingControl = new FormControl("pending");
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

  constructor(
    private bookingService:BookingService,  
    private _dialog: MatDialog,
    private _snackBar: MatSnackBar
  ) {

  }

  ngOnInit(): void {
    //throw new Error('Method not implemented.');
    this.get("", "", this.filterBookingControl.value ?? "");
    this.filterBookingControl.valueChanges.subscribe((val) => {
      if( val ){
        this.pageIndex = 0;
        this.pageSize = 5;
        this.get("", "", val ?? "");
      }
    })
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
    this.get("", "", this.filterBookingControl.value ?? "");
  }

  get(sort: string, orderby: string, search: string){
    this.isLoading = true;
    this.bookingService.getLoans(sort, orderby, search, (this.pageIndex + 1), this.pageSize).subscribe(
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
      })
  }

  openConfirmDialog(bookingId: string): void {
    const dialogRef = this._dialog.open(ModalsComponent, {
      width: '350px',
      data: { message: '¿Estás seguro de procesar la devolución?' }
    });
    this.isLoading = true;
    dialogRef.afterClosed().subscribe(result => {
      if (result) {
        this.bookingService.returned(bookingId).subscribe(
          response => {
            console.log('devuelto correctamente');
            this.openSnackBar();
            this.get("", "", this.filterBookingControl.value ?? "");
            this.isLoading = false;
          }, 
          error =>{
            console.log('Error al actualizar el elemento');
            this.isLoading = false;
          });
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

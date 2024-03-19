import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormControl, FormGroup, Validators } from '@angular/forms';
import { BookService } from 'src/app/providers/book/book.service';
import { Book } from 'src/app/models/book/book.model';
import { ActivatedRoute } from '@angular/router';

@Component({
  selector: 'app-book-edit',
  templateUrl: './book-edit.component.html',
  styleUrls: ['./book-edit.component.scss']
})
export class BookEditComponent implements OnInit {

  bookId: string;
  book: any;
  bookForm: FormGroup;

  constructor(
    private route: ActivatedRoute,
    private _fb:FormBuilder,
    private bookService: BookService
  ){
    this.bookForm = this._fb.group({
      title: new FormControl('',[Validators.required]),
      author: new FormControl('',[Validators.required]),
      category: new FormControl('',[Validators.required]),
      publisher: new FormControl('',[Validators.required]),
      publication_date: new FormControl('',[Validators.required]),
      cover_image: new FormControl('',[Validators.required]),
      summary: new FormControl('',[Validators.required])
    })
  }

  ngOnInit(): void {
    this.bookId = this.route.snapshot.paramMap.get('id');
    this.get(this.bookId);
    //alert(this.route.snapshot.paramMap.get('id'));
  }

  get(bookId: string){
    this.bookService.getBook(bookId).subscribe(
      response => {
        this.book = response.message;
        this.fillBookForm();
      },
      error => {

      });
  }

  fillBookForm(){
    this.bookForm.patchValue({
      title: this.book.title,
      category: this.book.category,
      author: this.book.author,
      publisher: this.book.publisher,
      publication_date: this.book.publication_date,
      cover_image: this.book.cover_image,
      summary: this.book.summary,
    });
  }

  onFormSubmit(){
    if( this.bookForm.valid ){
      let valueFrom: any = this.bookForm.value;
      const bookModel: Book = {
        id: valueFrom.id,
        title: valueFrom.title,
        author: valueFrom.author,
        category: valueFrom.category,
        publisher: valueFrom.publisher,
        publication_date: valueFrom.publication_date,
        cover_image: valueFrom.cover_image,
        summary: valueFrom.summary,
      }
      

      this.bookService.updateBook(bookModel, this.bookId).subscribe(
        (response: any) => {
          console.log(response.code);
          //return response.code;
          //this.router.navigate(['cotizador/confirmacion']);
          /*if (!response.code) {
            //localStorage.clear();
            //this.router.navigate(['cotizador/confirmacion']);
          } else {
            //this.toastr.error(response.message);
          }*/
        },(err) => {
          //this.toastr.error(err.message);
        }
      );

      console.log(bookModel.author);
    }
  }

}

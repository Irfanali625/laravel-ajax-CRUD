   <script src="https://code.jquery.com/jquery-3.6.4.min.js"
       integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
   <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
   <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>

   <script>
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });

       $(document).ready(function() {

           // Insert Record in Ajax
           //    $('.add_product').on("click", function(e) {
           $(document).on('click', '.add_product', function(e) {
               //    alert('test');
               e.preventDefault();
               let name = $('#name').val();
               let price = $('#price').val();
               //    console.log(name + price);

               $.ajax({
                   url: "{{ route('add.product') }}",
                   method: 'post',
                   data: {
                       name: name,
                       price: price
                   },
                   success: function(res) {
                       if (res.status == 'success') {
                           $('#addModal').modal('hide');
                           $('#addProductForm')[0].reset();
                           //    $('#table').load(location.href('.refresh'));
                           //    $('table').load(location.href + '.table');
                       }
                       location.reload();
                   },
                   error: function(err) {
                       let error = err.responseJSON;
                       $.each(error.errors, function(index, value) {
                           $('.errMsgContainer').append('<span class="text-danger">' +
                               value + '</span>' + '<br>');
                       });
                   }
               });
           });


           // Update value in Ajax form
           $('.update_product_form').on("click", function() {
               let id = $(this).data('id');
               let name = $(this).data('name');
               let price = $(this).data('price');
               //    console.log(id);
               $('#up_id').val(id);
               $('#up_name').val(name);
               $('#up_price').val(price);
           });

           //    Upadte record in Ajax
           $('.update_product').on("click", function(e) {
               //    alert('test');
               e.preventDefault();
               let up_id = $('#up_id').val();
               let up_name = $('#up_name').val();
               let up_price = $('#up_price').val();
               console.log(up_id + up_name + up_price);

               $.ajax({
                   url: "{{ route('update.product') }}",
                   method: 'post',
                   data: {
                       up_id: up_id,
                       up_name: up_name,
                       up_price: up_price,
                   },
                   success: function(res) {
                       if (res.status == 'success') {
                           $('#updateModal').modal('hide');
                           $('#updateProductForm')[0].reset();
                           //    $('#table').load(location.href('.refresh'));
                           //    $('.table').load(location.href + '.table');
                       }
                       location.reload();
                   },
                   error: function(err) {
                       let error = err.responseJSON;
                       $.each(error.errors, function(index, value) {
                           $('.errMsgContainer').append('<span class="text-danger">' +
                               value + '</span>' + '<br>');
                       });
                   }
               });
           });

           $('.delete_product').on("click", function(e) {
               //    alert('test');
               e.preventDefault();
               let product_id = $(this).data('id');
               //    alert(product_id);
               if (confirm('Do you want to delete this record ??')) {
                   //    alert(product_id);
                   $.ajax({
                       url: "{{ route('delete.product') }}",
                       method: 'POST',
                       data: {
                           'product_id': product_id
                       },
                       success: function(res) {
                           if (res.status == 'success') {
                               Command: toastr["success"]("Product Successfully Deleted")
                               toastr.options = {
                                   "closeButton": true,
                                   "debug": false,
                                   "newestOnTop": false,
                                   "progressBar": true,
                                   "positionClass": "toast-top-right",
                                   "preventDuplicates": false,
                                   "onclick": null,
                                   "showDuration": "300",
                                   "hideDuration": "1000",
                                   "timeOut": "5000",
                                   "extendedTimeOut": "1000",
                                   "showEasing": "swing",
                                   "hideEasing": "linear",
                                   "showMethod": "fadeIn",
                                   "hideMethod": "fadeOut"
                               }
                               //    location.reload();
                           }
                       }
                   });
               }
           });

           //    Pagination
           $(document).on('click', '.pagination a', function(e) {
               //    alert('yes');
               e.preventDefault();
               let page = $(this).attr('href').split('page=')[1]
               product(page)
           });

           function product(page) {
               $.ajax({
                   url: '/pagination/paginate-data?page=' + page,
                   success: function(res) {
                       $('.table-data').html(res);
                   }
               })
           }

           $(document).on('keyup', function(e) {
               e.preventDefault();
               let search_str = $('#search').val();
               //    console.log(search_str);

               $.ajax({
                   url: "{{ route('search.product') }}",
                   method: 'GET',
                   data: {
                       search_str: search_str
                   },
                   success: function(res) {
                       $('.table-data').html(res);
                       if (res.status == 'Nothing Found') {
                           $('.table-data').html(
                               '<span class="text-danger d-flex justify-content-center">' +
                               'Nothing Found' + '</span>'
                           );
                       }
                   }
               });
           })
       });
   </script>

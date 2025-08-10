 $(function(){
    $(document).on('click','#delete',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


                  Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete This Data?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                      )
                    }
                  })


    });

  });

  // Confirm Orders
   $(function(){
    $(document).on('click','#confirm',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


                  Swal.fire({
                    title: 'Are you sure to Confirm?',
                    text: "Once Confirm, You will not be able to Pending Again?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, confirm it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Confirm!',
                        'Confirm Changes',
                        'success'
                      )
                    }
                  })


    });

  });


  // Processing Orders
   $(function(){
    $(document).on('click','#processing',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


                  Swal.fire({
                    title: 'Are you sure to Processing?',
                    text: "Once Processing, You will not be able to Back Again?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Processing it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Processing!',
                        'Processing Changes',
                        'success'
                      )
                    }
                  })


    });

  });

    // Picked Orders
   $(function(){
    $(document).on('click','#picked',function(e){
        e.preventDefault();
        let link = $(this).attr("href");


                  Swal.fire({
                    title: 'Are you sure to Picked?',
                    text: "Once Picked, You will not be able to Pending Again?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Picked it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Picked!',
                        'Picked Changes',
                        'success'
                      )
                    }
                  })


    });

  });

   // Shipped Orders
   $(function(){
    $(document).on('click','#shipped',function(e){
        e.preventDefault();
        let link = $(this).attr("href");

                  Swal.fire({
                    title: 'Are you sure to Shipped?',
                    text: "Once Shipped, You will not be able to Pending Again?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Shipped it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Shipped!',
                        'Shipped Changes',
                        'success'
                      )
                    }
                  })


    });

  });

   // Delivered Orders
   $(function(){
    $(document).on('click','#delivered',function(e){
        e.preventDefault();
        let link = $(this).attr("href");

                  Swal.fire({
                    title: 'Are you sure to delivered?',
                    text: "Once Delivered, You will not be able to Pending Again?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Shipped it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Delivered!',
                        'Delivered Changes',
                        'success'
                      )
                    }
                  })


    });

  });


   // Cancel Orders
   $(function(){
    $(document).on('click','#cancel',function(e){
        e.preventDefault();
        let link = $(this).attr("href");

                  Swal.fire({
                    title: 'Are you sure to cancel?',
                    text: "Once Cancel, You will not be able to Pending Again?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Shipped it!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Cancel!',
                        'Cancel Changes',
                        'success'
                      )
                    }
                  })


    });

  });


   // Approve Review Orders
$(function(){
    $(document).on('click','#review',function(e){
        e.preventDefault();
        let link = $(this).attr("href");

        Swal.fire({
            title: 'Are you sure you want to approve?',
            text: "Once approved, you will not be able to set it to pending again.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Approve it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = link;
                Swal.fire(
                    'Approved!',
                    'Order has been approved successfully.',
                    'success'
                );
            }
        });
    });
});
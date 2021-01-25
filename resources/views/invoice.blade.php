<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <title>Hello, world!</title>
    </head>
    <body>
        <div class="container">
            <div class="row mt-4">
                <div class="col-md-6">
                    <h5>From</h5>
                    <address>
                        admin
                        A-400, Asok Nagar<br>
                        01845392010<br>
                        admin@gmail.com
                    </address>
                </div>
                <div class="col-md-6">
                    <h5>To</h5>
                    <input type="text" class="form-control mb-2"  id="test" />
                    <textarea class="form-control mb-2"></textarea>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"><input type='checkbox' disabled></th>
                                <th scope="col">Item No</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        <tbody id="myTable">
                            
                        </tbody>
                    </table>
                    <br>
                    <button class="btn btn-danger" id="removeItem">- Delete</button>
                    <button class="btn btn-success" id="addRow">+ Add More</button>
                    <h4 class="lead mt-4px mt-2">Notes</h4>
                    <textarea class="form-control" style="width:500px;"></textarea>
                    <button class="btn btn-success btn-lg mt-2">Save Invoice</button>
                    <div class="details " style="float:right">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">SubTotal</span>
                            </div>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <br>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter Percentage">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">Tax Ammount</span>
                            </div>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">Total</span>
                            </div>
                            <input type="text" class="form-control" readonly>
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">Ammount Paid</span>
                            </div>
                            <input type="text" class="form-control" placeholder="Enter Payable ammount">
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">Ammount Due</span>
                            </div>
                            <input type="text" class="form-control" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
</body>
</html>

<script>
    let counter = 1
    $('#addRow').on('click', function() {
    let tableBody = $('#myTable')
    let row = `<tr>
                    <td>
                    <input type='checkbox' name='record' id="singleRemove">
                    <td>
                        <input class="form-control" type="text" id="itemNo_${counter}"  />
                    </td>
                    <td>
                        <input class="form-control" type="text"  id="itemName_${counter}"  />
                    </td>
                    <td>
                        <input class="form-control" type="text"  id="quantity_${counter}"/>
                    </td>
                    <td>
                        <input class="form-control" type="number"  id="price_${counter}"/>
                    </td>
                    <td>
                        <input class="form-control" type="text"  id="total_${counter}"/>
                    </td>
                </tr>`
    tableBody.append(row)
    counter  +=1

    $('#removeItem').on('click', function() {
        $("#myTable").find('input[name="record"]').each(function() {
            if ($(this).is(":checked")) {
                $(this).parents("tr").remove();
            }
        });
    })
}) 


$('#price_1').on('click', function(){
    alert('sss')
})

</script>
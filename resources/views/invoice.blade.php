<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <meta name="csrf-token" content="{{ csrf_token() }}" />
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
                    <input type="text" class="form-control mb-2"  id="custName" placeholder="Enter the Customer Name"/>
                    <textarea class="form-control mb-2" placeholder="Enter the Customer Address" id="custAddress"></textarea>
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
                    <textarea class="form-control" style="width:500px;" id="invoiceNotes"></textarea>
                    <button class="btn btn-success btn-lg mt-2" id="saveInvoice">Save Invoice</button>
                    <div class="details " style="float:right">
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">SubTotal</span>
                            </div>
                            <input type="text" class="form-control" id="row-subtotal" readonly>
                        </div>
                        <br>
                        <div class="input-group">
                            <input type="number" class="form-control" id="row-tax-pecentage" placeholder="Enter Percentage">
                            <div class="input-group-append">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">Tax Ammount</span>
                            </div>
                            <input type="text" class="form-control" id="row-tax-ammount" readonly>
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">Total</span>
                            </div>
                            <input type="text" class="form-control" id="row-total" readonly>
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">Ammount Paid</span>
                            </div>
                            <input type="number" class="form-control" id="row-ammount-paid" placeholder="Enter Payable ammount">
                        </div>
                        <br>
                        <div class="input-group">
                            <div class="input-group-append">
                                <span class="input-group-text">Ammount Due</span>
                            </div>
                            <input type="number" class="form-control" id="row-ammount-due" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
  <!--   <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
</body>
</html>

<script>
    $('#addRow').on('click', function() {
        let tableBody = $('#myTable')
        let row = `<tr>
                        <td>
                        <input type='checkbox' name='record' id="singleRemove">
                        <td>
                            <input class="form-control row-itemNo" type="text" id="itemNo"  />
                        </td>
                        <td>
                            <input class="form-control row-itemName" type="text"  id="itemName"  />
                        </td>
                        <td>
                            <input class="form-control row-quantity" type="number"  id="quantity"/>
                        </td>
                        <td>
                            <input class="form-control row-price" type="number"  id="price"/>
                        </td>
                        <td>
                            <input class="form-control row-total" type="number" readonly id="total"/>
                        </td>
                    </tr>`
        tableBody.append(row)
    }) 
    $('table').on('mouseup keyup', 'input[type=number]', () => calculateTotals());
    let Items = []
    function calculateTotals(){
        /*Row column*/
        let quantityElements = $('.row-quantity')
        let priceElements    = $('.row-price')
        let totalElements    = $('.row-total')

        /* Grand calculate */
        let taxPercentagetElement   = $('#row-tax-pecentage');
        let subTotalElement         = $('#row-subtotal');
        let grandTotalElement       = $('#row-total');
        let taxAmmountElement       = $('#row-tax-ammount');
        let ammountPaidElement      = $('#row-ammount-paid');
        let ammountDueElement       = $('#row-ammount-due');

        let subTotal = 0
        let taxAmmount = 0
        let GrandTotal = 0
        $(quantityElements).each(function(i, e){
            if(i === 0 ){
                Items = []
            }
            let itemNoElement   = $('.row-itemNo:eq(' + i + ')');
            let nameElement     = $('.row-itemName:eq(' + i + ')')
            let quantityElement = $('.row-quantity:eq(' + i + ')')
            let priceElement    = $('.row-price:eq(' + i + ')')
            let totalElement    = $('.row-total:eq(' + i + ')')

           let total = quantityElement.val() * priceElement.val()
            totalElement.val(total)
            subTotal = subTotal + total
            Item = {
                item_number: itemNoElement.val(),
                item_name: nameElement.val(),
                price: priceElement.val(),
                quantity: quantityElement.val(),
                product_total: totalElement.val(),
            }
            Items.push(Item)
        })
        /*Calculate GrandTotal and calculate the Tax by percentage*/
        subTotalElement.val(subTotal)
        taxAmmount = (subTotalElement.val() * taxPercentagetElement.val())/100
        taxAmmountElement.val(taxAmmount)
        grandTotalElement.val(parseFloat(subTotalElement.val()) + taxAmmount)

        /*Calculate due*/

        let dueAmmount = parseFloat(grandTotalElement.val() - parseFloat(ammountPaidElement.val()))
        ammountDueElement.val(parseFloat(dueAmmount))
    }
    $('#removeItem').on('click', function() {
        $("#myTable").find('input[name="record"]').each(function() {
            if ($(this).is(":checked")) {
                $(this).parents("tr").remove();
            }
        });
    })

    $('#row-tax-pecentage').on('keyup', function(){
        calculateTotals()
    })
    $('#row-ammount-paid').on('keyup', function(){
        calculateTotals()
    })
    const url = '{{ route("orderStore") }}';
    const token = document.querySelector(`meta[name='csrf-token']`).content;
    $('#saveInvoice').on('click', function(e){
        e.preventDefault()
        /*Customer Info*/
        let custName    = $('#custName').val()
        let custAddress = $('#custAddress').val()

        /*Invoice Details*/
        let itemNoElements     = $('.row-itemNo').val()
        let nameElements       = $('.row-itemName').val()
        let percentageRate     = $('#row-tax-pecentage').val()
        let subTotal           = $('#row-subtotal').val()
        let grandTotal         = $('#row-total').val()
        let taxAmmount         = $('#row-tax-ammount').val()
        let ammountPaidElement = $('#row-ammount-paid').val()
        let ammountDueElement  = $('#row-ammount-due').val()
        let invoiceNotes       = $('#invoiceNotes').val()
        $.ajax({
            url:url,
            type:'POST',
            data:{
                _token: token,
                items:Items,
                custName:custName,
                custAddress:custAddress,
                percentageRate:percentageRate,
                subTotal:subTotal,
                grandTotal:grandTotal,
                taxAmmount:taxAmmount,
                ammountPaidElement:ammountPaidElement,
                ammountDueElement:ammountDueElement,
                invoiceNotes:invoiceNotes
            },
            dataType:"JSON",
            success:function(response){
                if(response.status){
                    let orderId = response.orderId
                    window.open("http://127.0.0.1:8000/generate-pdf/"+orderId, "_blank")
                let itemNoElements     = $('.row-itemNo').val('')
                let nameElements       = $('.row-itemName').val('')
                let percentageRate     = $('#row-tax-pecentage').val('')
                let subTotal           = $('#row-subtotal').val('')
                let grandTotal         = $('#row-total').val('')
                let taxAmmount         = $('#row-tax-ammount').val('')
                let ammountPaidElement = $('#row-ammount-paid').val('')
                let ammountDueElement  = $('#row-ammount-due').val('')
                let invoiceNotes       = $('#invoiceNotes').val('')
                let quantityElements = $('.row-quantity').val('')
                let priceElements    = $('.row-price').val('')
                let totalElements    = $('.row-total').val('')
                let custName    = $('#custName').val('')
                let custAddress = $('#custAddress').val('')
                }
            },
            error:function(error){
                console.log(error)
            }
        });
    })

</script>
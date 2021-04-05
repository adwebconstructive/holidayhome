<html>
    <head>
    </head>
<body>
    <table width="100%" border="1" colspace='1'>
        <thead>
            <tr>
                <td>Hotel Name</td>
                <td>{{$details->hotel->name}}</td>
            </tr>
            <tr>
                <td>Room No</td>
                <td>{{$details->room->room_number}}</td>
            </tr>
            <tr>
                <td>Check In</td>
                <td>{{$details->from}}</td>
            </tr>
            <tr>
                <td>Check Out</td>
                <td>{{$details->to}}</td>
            </tr>
            <tr>
                <td>Rate</td>
                <td>{{$details->rate}}</td>
            </tr>
        </tbody>
      </table>
      <hr>
      <div style="float: right;mergin-top:1em;width:100%">
            Id - {{$user->id}}<br>
            Name - {{$user->name}}<br>
            Email - {{$user->email}}
      </div>
    
</body>
</html>
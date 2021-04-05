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
      <br>
      <br>
      <div style="width:100%;text-align:center;padding:1em;">
        If you have any Query Please contact : test@gmail.com
      </div>
</body>
</html>
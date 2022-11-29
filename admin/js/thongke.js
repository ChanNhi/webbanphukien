$(document).ready(function(){
    thongke();
    var char = new Morris.Line({

      element: 'myfirstchart',

      xkey: 'date',

      ykeys: ['date','order','sales','quantity'],

      labels: ['Ngày','Đơn hàng', 'Doanh thu','Số lượng bán ra'],
      lineColors: ['#03fccf','#02f744'],
      pointFillColors: ['#0394fc'],
      pointStrokeColors: ['blue'],
    });
    // Morris.Donut({
    //   element: 'donut-example',
    //   data: [
    //     {label: "Sản phẩm", value: 12},
    //     {label: "Đơn hàng", value: 30},
    //     {label: "Doanh thu", value: 20}
    //   ]
    // });
    $('#select-thongke').change(function(){
      var thoigian = $(this).val();
      if(thoigian == '7ngay'){
        var text = '7 ngày qua';
      }else  if(thoigian == '28ngay'){
        var text = '28 ngày qua';
      }else  if(thoigian == '90ngay'){
        var text = '90 ngày qua';
      }else  if(thoigian == '365ngay'){
        var text = '365 ngày qua';
      }
      $.ajax({
        url:'modules/thongke.php',
        method:"POST",
        dataType:"JSON",
        data:{thoigian:thoigian},
        success:function(data){
          char.setData(data);
          $('#text-date').text(text);
        }
      });
    })

    function thongke(){
      var text = '365 ngày qua';
      $('#text-date').text(text);
      $.ajax({
          url:"modules/thongke.php",
          method:"POST",
          dataType:"JSON",
          success:function(data){
              char.setData(data);
              $('#text-date').text(text);
          }
      })
    }
})

@extends('email.layouts.master')

@section('body')
    <table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;">
        <tbody>
      
   
        
        
        <tr>
            <td style="padding: 30px 30px 20px">
               {!! $content !!}
                
                
            </td>
        </tr>


        </tbody>
    </table>
@endsection

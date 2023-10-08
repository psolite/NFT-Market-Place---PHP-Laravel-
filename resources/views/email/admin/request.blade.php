@extends('email.layouts.master')

@section('body')
    <table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;">
        <tbody>
      
        <tr>
            <td style="padding: 30px 30px 20px">
              Hi, Admin
            </td>
        </tr>
        
        
        <tr>
            <td style="padding: 0 30px">
                <p>Name: {{ $name }}</p> 
                <p>Subject: {{ $subject }}</p>
                <p>Message : {{ $content }}</p>
            </td>
        </tr>

        <tr>
            <td style="padding: 30px 30px 20px">
              Best regards,
              Bull Developers
            </td>
        </tr>

        </tbody>
    </table>
@endsection

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <link href="https://fonts.googleapis.com/css?family=Gloria+Hallelujah|Indie+Flower|Nanum+Pen+Script|Pacifico" rel="stylesheet">
        <title>Postcard {{ $postcard->id }}</title>
    </head>
    <body>
        <style>
            @page { size: 154mm 111mm; margin: 0;  }
            .page-break{ page-break-after: always; }

            /* POSTCARD FONTS */
              .font-family-1{
                font-family: 'Pacifico', cursive;
                font-size: 15px;
              }
              .font-family-1.font-size-15{ font-size: 12px; }
              .font-family-1.font-size-18{ font-size: 15px; }
              .font-family-1.font-size-21{ font-size: 18px; }
              .font-family-1.font-size-24{ font-size: 21px; }

              .font-family-2{
                font-family: 'Indie Flower', cursive;
                font-size: 15px;
              }
              .font-family-2.font-size-15{ font-size: 12px; }
              .font-family-2.font-size-18{ font-size: 15px; }
              .font-family-2.font-size-21{ font-size: 18px; }
              .font-family-2.font-size-24{ font-size: 21px; }

              .font-family-3{
                font-family: 'Nanum Pen Script', cursive;
                font-size: 25px;
              }
              .font-family-3.font-size-15{ font-size: 22px; }
              .font-family-3.font-size-18{ font-size: 25px; }
              .font-family-3.font-size-21{ font-size: 28px; }
              .font-family-3.font-size-24{ font-size: 31px; }

              .font-family-4{
                font-family: 'Gloria Hallelujah', cursive;
                font-size: 15px;
              }
              .font-family-4.font-size-15{ font-size: 12px; }
              .font-family-4.font-size-18{ font-size: 15px; }
              .font-family-4.font-size-21{ font-size: 18px; }
              .font-family-4.font-size-24{ font-size: 21px; }
            /* END POSTCARD FONTS */

            * { box-sizing: border-box; }

            .postcard-front, .postcard-back{
                position: relative;
                width: 154mm;
                height: 111mm;
                margin: auto;
                overflow: hidden;
            }

            .postcard-front > img{
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
            }

            .back-text{
                position: absolute;
                top: 5mm;
                left: 6.5mm;
                height: 91mm;
                color: {{$postcard->back_color}};
            }

            .postcard-back.has-reciever-address .back-text{
                width: 75mm;
            }

            .postcard-back.full-text .back-text{
                width: 141mm;
            }

            .reciever{
                border-left: solid 1px gainsboro;
                position: absolute;
                /*bottom: 10mm;*/
                top: 5mm;
                right: 0;
                width: 68mm;
                height: 91mm;
            }

            .reciever-content{
                position: absolute;
                /*bottom: 0;*/
                /*left: 0;*/
                top: 43mm;
                left: 8mm;
                width: 53mm;
                /*margin-bottom: 7mm;*/
                /*margin-left: 4.75mm;*/
                /*transform: translateY(-50%);*/
            }

            .reciever .reciever-data{
                padding-top: 3mm;
                padding-bottom: 2mm;
                padding-left: 1mm;
                padding-right: 1mm;
                font-family: BlinkMacSystemFont, -apple-system, "Segoe UI", "Roboto", "Oxygen", "Ubuntu", "Cantarell", "Fira Sans", "Droid Sans", "Helvetica Neue", "Helvetica", "Arial", sans-serif;

                font-size: 13px;
                font-weight: lighter;
                color: #444;
            }

            @php
                $full_text = $postcard->show_back_reciever ? false : true;
            @endphp

                .back-text > img { position: absolute; }
                .back-text > img.bottom-right{ bottom: 0; right: 0; transform: translateY(-100%);}
                .back-text > img.bottom-left{ bottom: 0; left: 0; transform: translateY(-100%);}
                .back-text > img.bottom-center{
                    bottom: 0;
                    left: {{$full_text ? '71.5mm' : '38.5mm'}};
                    transform: translate(-50%, -100%);
                }

                .back-text > img.center-right{ top: 50.5mm; right: 0; transform: translateY(-50%); }
                .back-text > img.center-left{ top: 50.5mm; left: 0; transform: translateY(-50%); }
                .back-text > img.center-center{
                    top: 50.5mm;
                    left: {{$full_text ? '71.5mm' : '38.5mm'}};
                    transform: translate(-50%, -50%);
                }

                .back-text > img.top-right{ top: 0; right: 0; }
                .back-text > img.top-left{ top: 0; left: 0; }
                .back-text > img.top-center{
                    top: 0;
                    left: {{$full_text ? '71.5mm' : '38.5mm'}};
                    transform: translateX(-50%);
                }

                .company-logo-img { width: {{$postcard->company_logo_width / 4.65}}mm; }
                .signature-img { width: {{$postcard->signature_width / 4.65}}mm; }

                /*.postcard-back > img{
                    position: absolute;
                    top: 0;
                    left: 0;
                    width: 100%;
                }*/

            .postcard-back.has-back-image > img{
                position: absolute;
                top: {{$postcard->custom_back_image_orientation == 'horizontal' ? '0' : '50%'}};
                left: {{$postcard->custom_back_image_orientation == 'vertical' ? '0' : '50%'}};
                width: {{$postcard->custom_back_image_orientation == 'vertical' ? '100%' : 'auto'}};
                height: {{$postcard->custom_back_image_orientation == 'horizontal' ? '100%' : 'auto'}};
                transform: {{$postcard->custom_back_image_orientation == 'horizontal' ? 'translate(-50%, 0)' : 'translate(0, -50%)'}};
            }
        </style>
        <div class="postcard">
            <div class="postcard-front">
                <img src="{{$postcard->front_cropped_file_path}}">
            </div>

            @if($postcard->has_custom_back_image)
                <div class="page-break"></div>
                <div class="postcard-back {{$postcard->show_back_reciever ? 'has-reciever-address' : 'full-text'}} {{$postcard->has_custom_back_image ? 'has-back-image' : ''}}">
                    <img src="{{$postcard->custom_back_image_file_path}}">
                </div>
            @else
                @if($postcard->show_back_reciever)
                    @foreach($reciever_data_addresses as $address)
                        <div class="page-break"></div>
                        <div class="postcard-back {{$postcard->show_back_reciever ? 'has-reciever-address' : 'full-text'}} {{$postcard->has_custom_back_image ? 'has-back-image' : ''}}">
                            @if($postcard->has_custom_back_image)
                                <img src="{{$postcard->custom_back_image_file_path}}">
                            @else
                                <div class="back-text font-family-{{$postcard->font_family}} font-size-{{$postcard->font_size}}">
                                    {{$postcard->back_text}}
                                    @if($postcard->company_logo_file_path)
                                        <img src="{{$postcard->company_logo_file_path}}" class="company-logo-img {{$postcard->company_logo_position}}">
                                    @endif
                                    @if($postcard->signature_file_path)
                                        <img src="{{$postcard->signature_file_path}}" class="signature-img {{$postcard->signature_position}}">
                                    @endif
                                </div>
                                <div class="reciever">
                                    <div class="reciever-content">
                                        <div class="reciever-data name">{{$address->name}} {{$address->surnames}}</div>
                                        <div class="reciever-data address">{{$address->address_line_1}}</div>
                                        <div class="reciever-data zip-code-city">{{$address->zip_code}} {{$address->city}}</div>
                                        <div class="reciever-data country">{{$address->country}}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                @else
                    <div class="page-break"></div>
                    <div class="postcard-back {{$postcard->show_back_reciever ? 'has-reciever-address' : 'full-text'}} {{$postcard->has_custom_back_image ? 'has-back-image' : ''}}">
                        <div class="back-text font-family-{{$postcard->font_family}} font-size-{{$postcard->font_size}}">
                            {{$postcard->back_text}}
                            @if($postcard->company_logo_file_path)
                                <img src="{{$postcard->company_logo_file_path}}" class="company-logo-img {{$postcard->company_logo_position}}">
                            @endif
                            @if($postcard->signature_file_path)
                                <img src="{{$postcard->signature_file_path}}" class="signature-img {{$postcard->signature_position}}">
                            @endif
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </body>
</html>

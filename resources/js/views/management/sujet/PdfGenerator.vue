<template>
  <div ref="content">
    <VueHtml2pdf
      ref="html2Pdf"
      :show-layout="false"
      :float-layout="true"
      :enable-download="false"
      :preview-modal="true"
      :paginate-elements-by-height="1400"
      filename="myPDF"
      :pdf-quality="2"
      :manual-pagination="false"
       @hasDownloaded="hasGenerated($event)"
      pdf-format="a4"
      pdf-orientation="landscape"
      pdf-content-width="100%"
      class="card"
    >
      <section slot="pdf-content" style="height:48.3rem ; " id="html" >
        <!-- PDF Content Here -->

        <div class="mx-auto" style="background:#E8EEF9; width:98%; height:100%; margin-top:10px ">
          <div class="h-13 relative flex justify-center m-auto text-center" style="width:98%; ">
            <div class="h-10 w-2/3 font-semibold  self-center" style="color:#063476;">
              <span class="amz">ⴰⵔⵔⴰ ⵍⴰⵙⵙⴻⵍ - ⵎⴴⵕⵉⴱ</span>
            </div>
            <div class="h-10 self-start absolute left-0" style="color:#063476;">
              <span class="eng">PEDIGREE OFFICIEL-MARCO</span>
            </div>
            <div class="h-10 self-end absolute right-0" style="color:#063476;">
              <span class="arb">شهادة الاصل -الرسمية المغرب</span>
            </div>
          </div>
          <div class="m-auto border" style="width:98%; height:84% ">
            <img
              src="\images\pdf_bg.png"
              class="absolute left-31 opacity-20"
              alt="image"
              style="width:57rem ; transform :translate(58px,-15px)"
            />
            <div
              class="arb absolute opacity-10 top-60 left-80 uppercase"
              style="font-size:80PX;color:#063476;"
            >المملكة المغربية</div>

            <div
              class="eng absolute opacity-10 bottom-80 right-60 uppercase"
              style="font-size:57PX;color:#063476;"
            >royaume du Maroc</div>
            <div class="grid grid-cols-3 divide-x	divide-stone-400 w-full h-full" style="">
              <div id="row" class="bg-white flex flex-col  rounded-tl-lg" style="height:100% ; border:none;">
                <div class="w-full h-2/5">
                <!-- top line -->
                  <div
                    style="height:0.2px; width:95.9%; margin-top:10px"
                    class="bg-black absolute"
                  />

                   <div style="height:0.5px; width:31.8%;  margin-top:10.5%" class="bg-black absolute right-6" />
                     <div style="height:0.5px; width:31.8%;  margin-top:33.4%" class="bg-black absolute right-6" />

                  <div class="bio-row ml-2 mr-2 -translate-y-1">
                    <div class="title -mr-2 -ml-2  font-semibold  text-blue-900 flex justify-between">
                      <h3 class="translate-x-2 font-semibold " style="font-size:11px">SUJET</h3>
                      <h3 class="-translate-x-2 font-semibold " style="font-size:11px">الحيوان</h3>
                    </div>

                    <div
                      style="font-size:9px;" class="flex   translate-y-1 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/4">Categorie :</span>
                      <div class=" text-gray-800 font-semibold  w-1/4">{{ pdfData.sujet.Type }}</div>
                      <div class=" text-gray-800 font-semibold  text-right w-1/4">بقرة</div>
                      <span class="-translate-x-2 w-1/4 flex justify-end">: النوع</span>
                    </div>

                    <div
                      style="font-size:9px;" class="flex  mt-2 translate-y-2 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/2">SNIT :</span>
                      <div class=" text-gray-800 font-semibold ">{{ pdfData.sujet.NSNIT }}</div>
                      <span class="-translate-x-2 w-1/2 flex justify-end">: رقم ألتعريف</span>
                    </div>

                    <div
                      style="font-size:9px;" class="flex  mt-2 translate-y-3 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/3">Date de vèlage :</span>
                      <div class=" text-gray-800 font-semibold  text-center">{{ getDate(pdfData.sujet.DateNaissance) }}</div>
                      <span class="-translate-x-2 w-1/3 flex justify-end">: تاريخ الازدياد</span>
                    </div>
                    <div
                      style="font-size:9px;" class="flex  mt-2 translate-y-4 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/4">Race:</span>
                      <div class=" text-gray-800 font-semibold  w-1/4">{{ pdfData.sujet.Race }}</div>
                      <div class=" text-gray-800 font-semibold  text-right w-1/4">بقرة</div>
                      <span class="-translate-x-2 w-1/4 flex justify-end">: السلالة</span>
                    </div>
                    <div
                      style="font-size:9px;" class="flex  mt-2 translate-y-5 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/4">Sexe:</span>
                      <div class=" text-gray-800 font-semibold  w-1/4">{{ pdfData.sujet.Sexe }}</div>
                      <div class=" text-gray-800 font-semibold  text-right w-1/4">بقرة</div>
                      <span class="-translate-x-2 w-1/4 flex justify-end">: الجنس</span>
                    </div>
                  </div>
                  <div class="title mr-2 ml-2  text-red-500 flex justify-between translate-y-7">
                    <h3
                      class="translate-x-2 font-semibold"
                      style="font-size:10px ; "
                    >PRODUCTION LAITIÈRE DU SUJET EN 3053</h3>
                    <h3
                      class="-translate-x-2 font-semibold "
                      style="font-size:10px ;"
                    >إنتاج الحليب في 3053 يوم</h3>
                  </div>

                  <div class="col text-center w-full relative translate-y-10">
                    <div class="table flex flex-col">
                      <tr class="th bg-gray-100  text-gray-800 font-semibold  w-full h-6 flex flex-row">
                        <div class="med_col" style="width:10% ;">N°</div>
                        <div class="med_col" style="width:22.4%">Age de Velage</div>
                        <div class="med_col" style="width:14.2%">Kg lat</div>
                        <div class="med_col" style="width:14.2%">%MG</div>
                        <div class="med_col" style="width:14.2%">Kg MG</div>
                        <div class="med_col" style="width:14.2%">%Prot</div>
                        <div class="end_col" style="width:14.2%">Kg Prot</div>
                      </tr>
                      <div
                        v-for="(item , i) in pdfData.PLS"
                        :key="i"
                        class="bg-white  text-gray-800 font-semibold  w-full h-5 flex flex-row border-0"
                      >
                        <div class="med_col" style="width:10%;">{{ i+=1 }}</div>
                        <div
                          class="med_col"
                          style="width:22.4%  "
                        >{{ item.AgeVelage ? item.AgeVelage :'__'}}</div>
                        <div
                          class="med_col"
                          style="width:14.2%  "
                        >{{item.KgLait ? parseFloat(item.KgLait).toFixed(2) :'__'}}</div>
                        <div
                          class="med_col"
                          style="width:14.2%  "
                        >{{item.MG ? parseFloat(item.MG).toFixed(2) :'__'}}</div>
                        <div
                          class="med_col"
                          style="width:14.2%  "
                        >{{item.KgMG ? parseFloat(item.KgMG).toFixed(2) :'__'}}</div>
                        <div
                          class="med_col"
                          style="width:14.2%  "
                        >{{item.Prot ?parseFloat(item.Prot).toFixed(2) :'__'}}</div>
                        <div
                          class="end_col"
                          style="width:14.2%  "
                        >{{item.KgProt ?parseFloat(item.KgProt).toFixed(2) :'__'}}</div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="w-full h-3/5">
                <!-- midel line -->

                  <div style="height:0.5px; width:95.8%;margin-left:0%;  " class="bg-black absolute -translate-y-1 "  />
                  <div class="bio-row ml-2 mr-2 -translate-y-2">
                    <div class="title -mr-2 -ml-2 mt-2 font-semibold  text-blue-900 flex justify-between">
                      <h3 class="translate-x-2 font-semibold " style="font-size:11px">INSEMINEE PAR</h3>
                      <h3 class="-translate-x-2 font-semibold " style="font-size:11px">ملقحة بالثور</h3>
                    </div>
                    <div
                      style="font-size:9px;" class="flex translate-y-1 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/2">NNI :</span>
                      <div class=" text-gray-800 font-semibold ">{{ pdfData.sujet.NSNIT }}</div>
                      <span class="-translate-x-2 w-1/2 flex justify-end">: رقم ألتعريف</span>
                    </div>

                    <div
                      style="font-size:9px;" class="flex  mt-2 translate-y-2 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/4">Race:</span>
                      <div class=" text-gray-800 font-semibold  w-1/4">{{ pdfData.sujet.Race }}</div>
                      <div class=" text-gray-800 font-semibold  text-right w-1/4">بقرة</div>
                      <span class="-translate-x-2 w-1/4 flex justify-end">: السلالة</span>
                    </div>

                    <div
                      style="font-size:9px;" class="flex  mt-2 translate-y-3 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/3">Date de naissance :</span>
                      <div
                        class=" text-gray-800 font-semibold  text-center"
                      >{{ getDate( pdfData.sujet.DateNaissance) }}</div>
                      <span class="-translate-x-2 w-1/3 flex justify-end">: تاريخ الازدياد</span>
                    </div>

                    <div
                      style="font-size:9px;" class="flex  mt-2 translate-y-4 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/3">Nom :</span>
                      <div class=" text-gray-800 font-semibold  text-center">test deJHVVG test</div>
                      <span class="-translate-x-2 w-1/3 flex justify-end">: الاسم</span>
                    </div>
                  </div>
                  <div class="title mr-1 ml-1  text-red-500 flex justify-between translate-y-8">
                    <h3
                      class="translate-x-2 "
                      style="font-size:10px ; font-weight:bold;"
                    >VALEURS GÉNÉTIQUES</h3>
                    <h3
                      class="-translate-x-2 font-semibold "
                      style="font-size:10px ; font-weight:bold;"
                    >القيم الجينية</h3>
                  </div>
                  <div class="grid grid-cols-1 gap-2 translate-y-3 mr-1 ml-1">
                    <div
                      style="font-size:8px"
                      class="text-start translate-x-2 font-semibold  grid grid-cols-6 gap-1 w-full translate-y-8"
                    >
                      <div>Lait :{{ pdf.indexLAIT.length ? pdfData.indexLAIT[0].Lait : ''}}</div>
                      <div>MG% :{{pdf.indexLAIT.length ? pdfData.indexLAIT[0].MG : ''}}</div>
                      <div>MGkg :{{pdf.indexLAIT.length ? pdfData.indexLAIT[0].MGkg : ''}}</div>
                      <div>Prot% :{{pdf.indexLAIT.length ? pdfData.indexLAIT[0].Prot : ''}}</div>
                      <div>ProtKg :{{pdf.indexLAIT.length ? pdfData.indexLAIT[0].ProtKg : ''}}</div>
                      <div>Pr:{{ pdf.indexLAIT.length ? pdfData.indexLAIT[0].Pr : ''}}</div>
                    </div>
                    <div
                      style="font-size:8px"
                      class="text-start translate-x-2 font-semibold  grid grid-cols-6 gap-1 w-full translate-y-8"
                    >
                      <div>SCS :{{ pdf.indexFOC.length ? pdfData.indexFOC[0].SCS : ''}}</div>
                      <div>LONG :{{ pdf.indexFOC.length ? pdfData.indexFOC[0].LONG : ''}}</div>
                      <div>FERT :{{ pdf.indexFOC.length ? pdfData.indexFOC[0].FERT : ''}}</div>
                      <div>FN :{{ pdf.indexFOC.length ? pdfData.indexFOC[0].FN : ''}}</div>
                      <div>FV :{{ pdf.indexFOC.length ? pdfData.indexFOC[0].FV : ''}}</div>
                      <div>Pr:{{ pdf.indexFOC.length ? pdfData.indexFOC[0].Pr : ''}}</div>
                    </div>
                    <div
                      style="font-size:8px"
                      class="text-start translate-x-2 font-semibold  grid grid-cols-6 gap-1 w-full translate-y-8"
                    >
                      <div>Devel :{{ pdf.indexPHOL.length ? pdfData.indexPHOL[0].Devel : ''}}</div>
                      <div>TypeB :{{ pdf.indexPHOL.length ? pdfData.indexPHOL[0].TypeBassin : ''}}</div>
                      <div>Membrs :{{ pdf.indexPHOL.length ? pdfData.indexPHOL[0].Membres : ''}}</div>
                      <div>Pis:{{ pdf.indexPHOL.length ? pdfData.indexPHOL[0].Pis : ''}}</div>
                      <div>Pr:{{ pdf.indexPHOL.length ? pdfData.indexPHOL[0].Pr : ''}}</div>
                    </div>
                  </div>
                  <div  style="font-size:9px;" class="bio-row ml-2 mr-2 translate-y-14">
                    <div class="title -mr-2 -ml-2 font-semibold  text-blue-900 flex justify-between">
                      <h3 class="translate-x-2 font-semibold " style="font-size:11px">ELEVEUR / NAISSEUR</h3>
                      <h3 class="-translate-x-2 font-semibold " style="font-size:11px">مربي الماشية</h3>
                    </div>

                    <div class="flex translate-y-1  text-gray-500 mt-2  w-full h-full justify-between">
                      <span class="translate-x-2 w-2/6">Nom :</span>
                      <div class=" text-gray-800 font-semibold  w-3/4">{{pdf.EN ?pdfData.EN.Nom:'' }}</div>
                      <div class=" text-gray-800 font-semibold  text-right w-1/4" />
                      <span class="-translate-x-2 w-1/4 flex justify-end">: الإ سم</span>
                    </div>

                    <div class="flex translate-y-2 text-gray-500 mt-1  w-full h-full justify-between">
                      <span class="translate-x-2  w-2/6">Prénom :  </span>
                      <div class=" text-gray-800 font-semibold  w-3/4">{{ pdf.EN ? pdfData.EN.Prenom :''}}</div>
                      <div class=" text-gray-800 font-semibold  text-right w-1/4" />
                      <span class="-translate-x-2 w-1/4 flex justify-end">: النسب</span>
                    </div>

                    <div class="flex translate-y-3 text-gray-500 mt-1  w-full h-full justify-between">
                      <span class="translate-x-2 w-1/6">Province :</span>
                      <div
                        class=" text-gray-800 font-semibold  text-center w-full"
                      >{{ pdf.EN ? pdfData.EN.Adresse :''}}</div>

                      <span class="-translate-x-2 w-1/6 flex justify-end">: الولاية</span>
                    </div>

                    <div class="QR translate-y-6 translate-x-2">
                      <qr-code :size="80" :text="pdfData.sujet.NTravail" error-level="L" />
                    </div>
                  </div>
                </div>
              </div>
              <div id="row" class="bg-white border-x-2 flex flex-col" style="height:100% ;">
                <div class="w-full h-2/5">
                  <div class="bio-row ml-2 mr-2 -translate-y-1">
                    <div class="title -mr-2 -ml-2 font-semibold  text-blue-900 flex justify-between">
                      <h3 class="translate-x-2 font-semibold " style="font-size:11px">PÈRE</h3>
                      <h3 class="-translate-x-2 font-semibold " style="font-size:11px">الأب</h3>
                    </div>
                    <div
                      style="font-size:9px;" class="flex  translate-y-1 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/2">NNI :</span>
                      <div class=" text-gray-800 font-semibold ">{{ pdf.pere ? pdfData.pere.N: '' }}</div>
                      <span class="-translate-x-2 w-1/2 flex justify-end">: رقم ألتعريف</span>
                    </div>

                    <div
                      style="font-size:9px;" class="flex  mt-2 translate-y-2 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/3">Date de naissance :</span>
                      <div
                        class=" text-gray-800 font-semibold  text-center"
                      >{{ pdf.pere ? getDate(pdfData.pere.Datenaissance): '' }}</div>
                      <span class="-translate-x-2 w-1/3 flex justify-end">: تاريخ الازدياد</span>
                    </div>

                    <div
                      style="font-size:9px;" class="flex  mt-2 translate-y-3 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/3">Nom :</span>
                      <div
                        class=" text-gray-800 font-semibold  text-center w-full"
                      >{{ pdf.pere ? pdfData.pere.Nom: '' }}</div>
                      <span class="-translate-x-2 w-1/3 flex justify-end">: الاسم</span>
                    </div>
                    <div
                      style="font-size:9px;" class="flex  mt-2 translate-y-4 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/4">Race:</span>
                      <div class=" text-gray-800 font-semibold  w-1/4">{{ pdf.pere ? pdfData.pere.Race: '' }}</div>
                      <div class=" text-gray-800 font-semibold  text-right w-1/4">بقرة</div>
                      <span class="-translate-x-2 w-1/4 flex justify-end">: السلالة</span>
                    </div>
                  </div>
                  <div class="title mr-1 ml-1 text-red-500 flex justify-between translate-y-11">
                     <h3
                      class="translate-x-2"
                      style="font-size:10px ; font-weight:bold;"
                    >VALEURS GÉNÉTIQUES</h3>
                    <h3
                      class="-translate-x-2 font-semibold "
                      style="font-size:10px ; font-weight:bold;"
                    >القيم الجينية</h3>
                  </div>
                  <div class="grid grid-cols-1 gap-2 translate-y-3 mr-1 ml-1">
                    <div
                      style="font-size:8px"
                      class="text-start translate-x-2 font-semibold  grid grid-cols-6 gap-1 w-full translate-y-11"
                    >
                      <div>Lait :{{ pdf.indexLAIT.length ? pdfData.indexLAIT[0].Lait : ''}}</div>
                      <div>MG% :{{pdf.indexLAIT.length ? pdfData.indexLAIT[0].MG : ''}}</div>
                      <div>MGkg :{{pdf.indexLAIT.length ? pdfData.indexLAIT[0].MGkg : ''}}</div>
                      <div>Prot% :{{pdf.indexLAIT.length ? pdfData.indexLAIT[0].Prot : ''}}</div>
                      <div>ProtKg :{{pdf.indexLAIT.length ? pdfData.indexLAIT[0].ProtKg : ''}}</div>
                      <div>Pr:{{ pdf.indexLAIT.length ? pdfData.indexLAIT[0].Pr : ''}}</div>
                    </div>
                    <div
                      style="font-size:8px"
                      class="text-start translate-x-2 font-semibold  grid grid-cols-6 gap-1 w-full translate-y-11"
                    >
                      <div>SCS :{{ pdf.indexFOC.length ? pdfData.indexFOC[0].SCS : ''}}</div>
                      <div>LONG :{{ pdf.indexFOC.length ? pdfData.indexFOC[0].LONG : ''}}</div>
                      <div>FERT :{{ pdf.indexFOC.length ? pdfData.indexFOC[0].FERT : ''}}</div>
                      <div>FN :{{ pdf.indexFOC.length ? pdfData.indexFOC[0].FN : ''}}</div>
                      <div>FV :{{ pdf.indexFOC.length ? pdfData.indexFOC[0].FV : ''}}</div>
                      <div>Pr:{{ pdf.indexFOC.length ? pdfData.indexFOC[0].Pr : ''}}</div>
                    </div>
                    <div
                      style="font-size:8px"
                      class="text-start translate-x-2 font-semibold  grid grid-cols-6 gap-1 w-full translate-y-11"
                    >
                      <div>Devel :{{ pdf.indexPHOL.length ? pdfData.indexPHOL[0].Devel : ''}}</div>
                      <div>TypeB :{{ pdf.indexPHOL.length ? pdfData.indexPHOL[0].TypeBassin : ''}}</div>
                      <div>Membrs :{{ pdf.indexPHOL.length ? pdfData.indexPHOL[0].Membres : ''}}</div>
                      <div>Pis:{{ pdf.indexPHOL.length ? pdfData.indexPHOL[0].Pis : ''}}</div>
                      <div>Pr:{{ pdf.indexPHOL.length ? pdfData.indexPHOL[0].Pr : ''}}</div>
                    </div>
                  </div>
                </div>
                <div class="w-full h-3/5">
                  <div class="bio-row ml-2 mr-2 mt-2 -translate-y-2">
                    <div class="title -mr-2 -ml-2 font-semibold  text-blue-900 flex justify-between">
                      <h3 class="translate-x-2 font-semibold " style="font-size:11px">MÈRE</h3>
                      <h3 class="-translate-x-2 font-semibold " style="font-size:11px">الأب</h3>
                    </div>
                    <div
                      style="font-size:9px;" class="flex  translate-y-1 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/2">NNI :</span>
                      <div class=" text-gray-800 font-semibold ">{{pdf.mere ? pdfData.mere.NSNIT: '' }}</div>
                      <span class="-translate-x-2 w-1/2 flex justify-end">: رقم ألتعريف</span>
                    </div>

                    <div
                      style="font-size:9px;" class="flex  mt-2 translate-y-2 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/3">Date de naissance :</span>
                      <div
                        class=" text-gray-800 font-semibold  text-center"
                      >{{pdf.mere ? getDate(pdfData.mere.DateNaissance): '' }}</div>
                      <span class="-translate-x-2 w-1/3 flex justify-end">: تاريخ الازدياد</span>
                    </div>

                    <div
                      style="font-size:9px;" class="flex  mt-2 translate-y-3 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/3">Nom :</span>
                      <div class=" text-gray-800 font-semibold  text-center">{{pdf.mere ? pdfData.mere.Nom: '' }}</div>
                      <span class="-translate-x-2 w-1/3 flex justify-end">: الاسم</span>
                    </div>
                    <div
                      style="font-size:9px;" class="flex  mt-2 translate-y-4 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/4">Race:</span>
                      <div class=" text-gray-800 font-semibold  w-1/4">{{pdf.mere ? pdfData.mere.Race: '' }}</div>
                      <div class=" text-gray-800 font-semibold  text-right w-1/4">بقرة</div>
                      <span class="-translate-x-2 w-1/4 flex justify-end">: السلالة</span>
                    </div>
                  </div>
                  <div class="title mr-2 ml-2
                    text-gray-800 font-semibold  flex justify-between translate-y-8">
                    <h3
                      class="translate-x-2"
                      style="font-size:10.5px ; font-weight:bold;"
                    >PRODUCTION LAITIÈRE EN 3053</h3>
                    <h3
                      class="-translate-x-2 font-semibold "
                      style="font-size:10px ; font-weight:bold;"
                    >إنتاج الحليب في 3053 يوم</h3>
                  </div>

                  <div class="col text-center w-full relative translate-y-14">
                    <div class="table flex flex-col">
                      <tr class="th bg-gray-100  text-gray-800 font-semibold  w-full h-6 flex flex-row">
                        <div class="med_col" style="width:10% ;">N°</div>
                        <div class="med_col" style="width:22.4%">Age de Velage</div>
                        <div class="med_col" style="width:14.2%">Kg lat</div>
                        <div class="med_col" style="width:14.2%">%MG</div>
                        <div class="med_col" style="width:14.2%">Kg MG</div>
                        <div class="med_col" style="width:14.2%">%Prot</div>
                        <div class="end_col" style="width:14.2%">Kg Prot</div>
                      </tr>
                      <div
                        v-for="(item , i) in pdfData.PLM"
                        :key="i"
                        class="bg-white  text-gray-800 font-semibold  w-full h-6 flex flex-row border-0"
                      >
                        <div class="med_col" style="width:10%;">{{ i+=1}}</div>
                        <div class="med_col" style="width:22.4%  ">{{ item.AgeVelage ?item.AgeVelage:'__' }}</div>
                        <div
                          class="med_col"
                          style="width:14.2%  "
                        >{{ (item.KgLait) ? parseFloat(item.KgLait).toFixed(2):'__' }}</div>
                        <div
                          class="med_col"
                          style="width:14.2%  "
                        >{{ (item.MG) ? parseFloat(item.MG).toFixed(2):'__' }}</div>
                        <div
                          class="med_col"
                          style="width:14.2%  "
                        >{{(item.KgMG) ? parseFloat(item.KgMG).toFixed(2): '__'}}</div>
                        <div
                          class="med_col"
                          style="width:14.2%  "
                        >{{(item.Prot)? parseFloat(item.Prot).toFixed(2):'__'}}</div>
                        <div
                          class="end_col"
                          style="width:14.2%  "
                        >{{(item.KgProt)? parseFloat(item.KgProt).toFixed(2):'__' }}</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div id="row" class="bg-white flex flex-col rounded-r-lg" style="height:100% ;">
                <div style="height:20%" class>
                  <div class="bio-row ml-2 mr-2 -translate-y-1">
                    <div class="title -mr-2 -ml-2 text-blue-900 flex justify-between">
                      <h3
                        class="translate-x-2 font-semibold  uppercase"
                        style="font-size:11px"
                      >Grande-père paternel</h3>
                      <h3 class="-translate-x-2 font-semibold " style="font-size:11px">اب الاب</h3>
                    </div>
                    <div
                      style="font-size:9px;" class="flex  translate-y-1 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/2">NNI :</span>
                      <div class=" text-gray-800 font-semibold ">{{ pdf.GPP ? pdfData.GPP.N :''}}</div>
                      <span class="-translate-x-2 w-1/2 flex justify-end">: رقم ألتعريف</span>
                    </div>

                    <div
                      style="font-size:9px;" class="flex  mt-2 translate-y-2 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/3">Date de naissance :</span>
                      <div
                        class=" text-gray-800 font-semibold  text-center"
                      >{{ pdf.GPP ? getDate(pdfData.GPP.DateNaissance) :''}}</div>
                      <span class="-translate-x-2 w-1/3 flex justify-end">: تاريخ الازدياد</span>
                    </div>

                    <div
                      style="font-size:9px;" class="flex  mt-2 translate-y-3 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/3">Nom :</span>
                      <div class=" text-gray-800 font-semibold  text-center w-5/6">{{ pdf.GPP ? pdfData.GPP.Nom :''}}</div>
                      <span class="-translate-x-2 w-1/3 flex justify-end">: الاسم</span>
                    </div>
                    <div
                      style="font-size:9px;" class="flex  mt-2 translate-y-4 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/4">Race:</span>
                      <div class=" text-gray-800 font-semibold  w-1/4">{{ pdf.GPP ? pdfData.GPP.Race :''}}</div>
                      <div class=" text-gray-800 font-semibold  text-right w-1/4">بقرة</div>
                      <span class="-translate-x-2 w-1/4 flex justify-end">: السلالة</span>
                    </div>
                  </div>
                </div>

                <div style="height:20%" class="">
                  <div class="bio-row ml-2 mr-2 -translate-y-1">
                    <div class="title -mr-2 -ml-2 text-blue-900 flex justify-between">
                      <h3
                        class="translate-x-2 font-semibold  uppercase"
                        style="font-size:11px"
                      >Grande-mère paternel</h3>
                      <h3 class="-translate-x-2 font-semibold " style="font-size:11px">ام الاب</h3>
                    </div>
                    <div
                      style="font-size:9px;" class="flex   translate-y-1 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/3">NNI :</span>
                      <div class=" text-gray-800 font-semibold  w-full text-center">{{ pdf.GPM ? pdfData.GMP.N :''}}</div>
                      <span class="-translate-x-2 w-1/3 flex justify-end">: رقم ألتعريف</span>
                    </div>

                    <div
                      style="font-size:9px;" class="flex  mt-2 translate-y-2 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/3">Date de naissance :</span>
                      <div
                        class=" text-gray-800 font-semibold  text-center"
                      >{{ pdf.GPM ? getDate(pdfData.GMP.DateNaissance) :''}}</div>
                      <span class="-translate-x-2 w-1/3 flex justify-end">: تاريخ الازدياد</span>
                    </div>

                    <div
                      style="font-size:9px;" class="flex  mt-2 translate-y-3 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/3">Nom :</span>
                      <div class=" text-gray-800 font-semibold  text-center">{{ pdf.GPM ? pdfData.GMP.Nom :''}}</div>
                      <span class="-translate-x-2 w-1/3 flex justify-end">: الاسم</span>
                    </div>
                    <div
                      style="font-size:9px;" class="flex  mt-2 translate-y-4 text-gray-500 w-full h-full justify-between"
                    >
                      <span class="translate-x-2 w-1/4">Race:</span>
                      <div class=" text-gray-800 font-semibold  w-1/4">{{ pdf.GPM ? pdfData.GMP.Race :''}}</div>
                      <div class=" text-gray-800 font-semibold  text-right w-1/4">بقرة</div>
                      <span class="-translate-x-2 w-1/4 flex justify-end">: السلالة</span>
                    </div>
                  </div>
                </div>
                <div class=" h-1/5">
                  <div style="height:20%" class="">
                    <div class="bio-row ml-2 mr-2 -translate-y-1">
                      <div class="title -mr-2 -ml-2 text-blue-900 flex justify-between">
                        <h3
                          class="translate-x-2 font-semibold  uppercase"
                          style="font-size:11px"
                        >Grande-Père Maternel</h3>
                        <h3 class="-translate-x-2 font-semibold " style="font-size:11px">ام الاب</h3>
                      </div>
                      <div
                        style="font-size:9px;" class="flex   translate-y-1 text-gray-500 w-full h-full justify-between"
                      >
                        <span class="translate-x-2 w-1/2">NNI :</span>
                        <div class=" text-gray-800 font-semibold ">{{ pdf.GPM ? pdfData.GPM.N :''}}</div>
                        <span class="-translate-x-2 w-1/2 flex justify-end">: رقم ألتعريف</span>
                      </div>

                      <div
                        style="font-size:9px;" class="flex  mt-2 translate-y-2 text-gray-500 w-full h-full justify-between"
                      >
                        <span class="translate-x-2 w-1/3">Date de naissance :</span>
                        <div
                          class=" text-gray-800 font-semibold  text-center"
                        >{{ pdf.GPM ? getDate(pdfData.GPM.DateNaissance) :''}}</div>
                        <span class="-translate-x-2 w-1/3 flex justify-end">: تاريخ الازدياد</span>
                      </div>

                      <div
                        style="font-size:9px;" class="flex  mt-2 translate-y-3 text-gray-500 w-full h-full justify-between"
                      >
                        <span class="translate-x-2 w-1/3">Nom :</span>
                        <div class=" text-gray-800 font-semibold  text-center w-full">{{ pdf.GPM ? pdfData.GPM.Nom :''}}</div>
                        <span class="-translate-x-2 w-1/3 flex justify-end">: الاسم</span>
                      </div>
                      <div
                        style="font-size:9px;" class="flex  mt-2 translate-y-4 text-gray-500 w-full h-full justify-between"
                      >
                        <span class="translate-x-2 w-1/4">Race:</span>
                        <div class=" text-gray-800 font-semibold  w-1/4">{{ pdf.GPM ? pdfData.GPM.Race :''}}</div>
                        <div class=" text-gray-800 font-semibold  text-right w-1/4">بقرة</div>
                        <span class="-translate-x-2 w-1/4 flex justify-end">: السلالة</span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class=" h-1/5">
                  <div style="height:40%" class="">
                    <div class="bio-row ml-2 mr-2 -translate-y-2">
                      <div class="title -mr-2 -ml-2 text-blue-900 flex justify-between">
                        <h3
                          class="translate-x-2 font-semibold  uppercase"
                          style="font-size:11px"
                        >Grande-mère Maternel</h3>
                        <h3 class="-translate-x-2 font-semibold " style="font-size:11px">ام الاب</h3>
                      </div>
                      <div
                        style="font-size:9px;" class="flex  translate-y-1 text-gray-500 w-full h-full justify-between"
                      >
                        <span class="translate-x-2 w-1/2">NNI :</span>
                        <div class=" text-gray-800 font-semibold ">{{ pdf.GMM ? pdfData.GMM.NSNIT :'' }}</div>
                        <span class="-translate-x-2 w-1/2 flex justify-end">: رقم ألتعريف</span>
                      </div>

                      <div
                        style="font-size:9px;" class="flex  mt-2 translate-y-2 text-gray-500 w-full h-full justify-between"
                      >
                        <span class="translate-x-2 w-1/3">Date de naissance :</span>
                        <div
                          class=" text-gray-800 font-semibold  text-center"
                        >{{ pdf.GMM ? getDate(pdfData.GMM.DateNaissance) :''}}</div>
                        <span class="-translate-x-2 w-1/3 flex justify-end">: تاريخ الازدياد</span>
                      </div>

                      <div
                        style="font-size:9px;" class="flex  mt-2 translate-y-3 text-gray-500 w-full h-full justify-between"
                      >
                        <span class="translate-x-2 w-1/3">Nom :</span>
                        <div class=" text-gray-800 font-semibold  text-center">{{ pdf.GMM ? pdfData.GMM.Nom :''}}</div>
                        <span class="-translate-x-2 w-1/3 flex justify-end">: الاسم</span>
                      </div>
                      <div
                        style="font-size:9px;" class="flex  mt-2 translate-y-4 text-gray-500 w-full h-full justify-between"
                      >
                        <span class="translate-x-2 w-1/4">Race:</span>
                        <div class=" text-gray-800 font-semibold  w-1/4">{{ pdf.GMM ? pdfData.GMM.Race :''}}</div>
                        <div class=" text-gray-800 font-semibold  text-right w-1/4">بقرة</div>
                        <span class="-translate-x-2 w-1/4 flex justify-end">: السلالة</span>
                      </div>
                    </div>
                    <div class="col text-center w-full relative translate-y-9">
                      <div class="table flex flex-col">
                        <tr class="th bg-gray-100  text-gray-800 font-semibold  w-full h-6 flex flex-row">
                          <div class="med_col" style="width:10% ;">N°</div>
                          <div class="med_col" style="width:22.4%">Age de Velage</div>
                          <div class="med_col" style="width:14.2%">Kg lat</div>
                          <div class="med_col" style="width:14.2%">%MG</div>
                          <div class="med_col" style="width:14.2%">Kg MG</div>
                          <div class="med_col" style="width:14.2%">%Prot</div>
                          <div class="end_col" style="width:14.2%">Kg Prot</div>
                        </tr>
                        <div
                          v-for="(item , i) in pdfData.PLMM"
                          :key="i"
                          class="bg-white  text-gray-800 font-semibold  w-full h-5 flex flex-row border-0"
                        >
                          <div class="med_col" style="width:10%;">{{ i+=1 }}</div>
                          <div
                            class="med_col"
                            style="width:22.4%  "
                          >{{ item.Age_V_lage ? item.Age_V_lage : '__'}}</div>
                          <div
                            class="med_col"
                            style="width:14.2%  "
                          >{{item.Kg_Lait ? parseFloat(item.Kg_Lait).toFixed(2) : '__'}}</div>
                          <div
                            class="med_col"
                            style="width:14.2%  "
                          >{{item.mg ? parseFloat(item.MG).toFixed(2) : '__'}}</div>
                          <div
                            class="med_col"
                            style="width:14.2%  "
                          >{{ item.KgMG ?parseFloat(item.KgMG).toFixed(2) :'__'}}</div>
                          <div
                            class="med_col"
                            style="width:14.2%  "
                          >{{item.Prot ? parseFloat(item.Prot).toFixed(2):'__' }}</div>
                          <div
                            class="end_col"
                            style="width:14.2%  "
                          >{{item.KgProt ? parseFloat(item.KgProt).toFixed(2): '__' }}</div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="container mx-auto h-24" style="font-size:11px">
              <div class="QR w-16 translate-y-2 h-16 absolute right-20">
                <qr-code :size="70" :text="pdfData.sujet.NTravail" error-level="L" />
              </div>
              <div class="flex flex-col w-5/6 translate-x-48 translate-y-4">
                <div class="grid grid-cols-2 text-gray-700 w-full h-1/2">
                  <div class="w-full flex flex-row">
                    <span>MAROC LAIT</span>
                  </div>

                  <div class="w-full flex flex-row">
                    <span>Rabat Le ...................</span>
                  </div>
                </div>
                <div class="grid grid-cols-2 text-gray-700 w-full h-1/2">
                  <div class="w-full flex flex-row">
                    <span>Autorisée par décision n° 281/5/BO/DDEP du 18/05/2021</span>
                  </div>

                  <div class="w-full flex flex-row">
                    <span>Signature et cachet</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </VueHtml2pdf>
  </div>
</template>
<script>
import VueHtml2pdf from 'vue-html2pdf';


export default {
  components: {
    VueHtml2pdf,
  },
  props: {
    pdfData: {
      type: Object,
      required: true,
      default: null,
    },
  },
  data() {
    return {
      pdf: {},
    };
  },

  watch: {
    pdf() {
      this.generateReport();
    },
    deep: true,
  },
  created() {
    this.pdf = this.pdfData;
  },
  methods: {
    generateReport() {
      if (this.pdf) {
        this.$refs.html2Pdf.generatePdf();


      }
    },
    hasGenerated(e){

     this.$emit('hasGenerated', e)
    },
    getDate(d) {
      if (d) {
        var rightNow = new Date(d).toISOString().slice(0, 10);
        return rightNow;
      }
      return 'this-is-date';
    },
  },
};
</script>

<style scoped>
@import url('https://fonts.googleapis.com/css2?family=Archivo+Black&family=Noto+Sans+Tifinagh&family=Reem+Kufi&display=swap');
.med_col {
  border-right-style: solid;
  border-right-width: 0.5px;
  border-right-color: rgba(46, 46, 46, 0.582);
  transform: translateY(2px);
}

.eng {
  font-family: 'Archivo Black', sans-serif;
}
.arb {
  font-family: 'Reem Kufi', sans-serif;
  font-stretch: expanded;
}
.amz {
  font-family: 'Noto Sans Tifinagh', sans-serif;
}
.table {
  font-size: 10px;
  width: 94%;
  position: absolute;
  left: 0;
  transform: translateX(8px);
}

.th {
  border-top-left-radius: 15px;
  border-top-right-radius: 15px;
  font-size: 9px;
}
span {
  font-weight: bold;
}
.QR {
}
</style>

@extends('pdfs.layout')
@section('title', 'Supplier Form')

@section('content')

    <div class="border-the-table">
        <table class="table table-borderless no-spacing" cellspacing="0" style="border-spacing: 0;">
            <thead>
                <tr>
                    <th class="header title">
                        <h6 class="mb-0 text-left">OXYGENE MARKETING COMMUNICATION LIMITED</h6>
                        <h5 class="mb-0 text-left">SUPPLIER FORM</h5>
                    </th>
                </tr>
                <tr>
                    <th>
                        <p class="mt-2 text-left">
                            <i>
                                (All information provided in this document shall be used solely for evaluation of any company’s ability, credibility and
                                willingness to become a supplier to Oxygene. Oxygene shall have the right to crosscheck any information with both the
                                supplier or any other government organization, business references and financial institutions to test the integrity of the
                                information provided. Any false information shall lead to automatic disqualification).
                            </i>
                        </p>
                        
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="px-0">
                        <p class="mb-0"><strong>1. BUSINESS/ CORPORATE INFORMATION</strong></p>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <!-- Break 1 -->
        <table class="table table-bordered no-spacing" cellspacing="0" style="border-spacing: 0;">
            <thead>
                <tr class="header">
                    <th class="tw-20px text-left">
                        No.
                    </th>
                    <th class="tw-280px text-left">
                        Particulars
                    </th>
                    <th class="text-left">
                        Response
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1.1</td>
                    <td>Full Name of Organization</td>
                    <td >
                        <div class="answer">
                            {{$data['step1']['full_name_organization']}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1.2</td>
                    <td>Physical Address/Principal Place of Business State plot No.</td>
                    <td >
                        <div class="answer">
                            {{$data['step1']['physical_address']}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1.3</td>
                    <td>Postal Address</td>
                    <td>
                        <div class="answer">
                            {{$data['step1']['postal_address']}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1.4</td>
                    <td>Telephone Number</td>
                    <td>
                        <div class="answer">
                            {{$data['step1']['telephone_number']}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1.5</td>
                    <td>KRA PIN No.</td>
                    <td>
                        <div class="answer">
                            {{$data['step1']['kra_pin_no']}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1.6</td>
                    <td>Company registration number</td>
                    <td>
                        <div class="answer">
                            {{$data['step1']['company_registration_no']}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1.7</td>
                    <td>Company E-Mail Address</td>
                    <td>
                        <div class="answer">
                            {{$data->company_email_address}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1.8</td>
                    <td>Contact for finance department(email, Name and Tel no:)</td>
                    <td class="dotted_text input">
                        <div class="mb-0">
                            <label>Name : </label>
                            <span class="answer">
                                {{$data['step1']['finance_dept_name']}}
                            </span>
                        </div>
                        <div class="mb-0 pt-3">
                            <label>Email : </label>
                            <span class="answer">
                                {{$data['step1']['finance_dept_email']}}
                            </span>
                        </div>
                        <div class="mb-0 pt-3">
                            <label>Tel no: </label>
                            <span class="answer">
                                {{$data['step1']['finance_dept_telno']}}
                            </span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1.9</td>
                    <td>Legal Entity: (a) Sole proprietor (b) Corporation (c) Partnership (d) Other</td>
                    <td>
                        <div class="answer">
                            @if($data['step1']['legal_entity'] === 'other')
                                {{$data['step1']['legal_entity_other']}}
                            @else
                                {{$data['step1']['legal_entity']}}
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1.10</td>
                    <td>Web Sites Address (if any)</td>
                    <td>
                        <div class="answer">
                            {{$data['step1']['web_site_address']}}
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="page-break"></div>
        
        <!-- Break 2 -->
        <table class="table table-bordered no-spacing" cellspacing="0" style="border-spacing: 0;">
            <thead class="">
                <tr class="header">
                    <th class="tw-20px text-left" colspan="7">
                        No.
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="tw-20px">1.11</td>
                    <td class="tw-280px" colspan="6">Directors contacts</td>
                    <tr>
                        <td class=""></td>
                        <td class="">Names</td>
                        <td class="ttw-25">Email</td>
                        <td>Identification No.</td>
                        <td class="">Nationality</td>
                        <td class="">Postal Address</td>
                        <td class="">Percentage shareholding (%)</td>
                    </tr>
                    @foreach ($data['step1']['list'] as $list)
                    <tr>
                        <td class=""></td>
                        <td>
                            <div class="answer">
                                {{$list['director_name']}}
                            </div>
                        </td>
                        <td>
                            <div class="answer">
                                {{$list['director_email']}}
                            </div>
                        </td>
                        <td>
                            <div class="answer">
                                {{$list['director_id_no']}}
                            </div>
                        </td>
                        <td>
                            <div class="answer">
                                {{$list['director_nationality']}}
                            </div>
                        </td>
                        <td>
                            <div class="answer">
                                {{$list['director_postal_address']}}
                            </div>
                        </td>
                        <td>
                            <div class="answer">
                                {{$list['director_per_shareholder']}}
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tr>
                <tr>
                    <td class="tw-20px">1.12</td>
                    <td colspan="3">
                        Have you changed your company name over the last 10 years? 
                        If so attach certificate of change of name. 
                        Also provide clear details outlining reasons and purpose of name change.
                    </td>
                    <td colspan="3">
                        <div class="answer">
                            @if($data['step1']['company_name_change'] === 'yes')
                                <div>Attachement: Yes</div>
                                <hr />
                                {{$data['step1']['reason_of_namechange']}}
                            @else
                                N/A
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1.13</td>
                    <td colspan="3">
                        Have you changed your company Directors or ownership in the last 10 years? 
                        If so, attach certificate of registration and/or latest annual returns. 
                        Also provide clear details outlining reasons and purpose of change of Directors
                    </td>
                    <td colspan="3">
                        <div class="answer">
                            @if($data['step1']['company_directors'] === 'yes')
                                <div>Attachement: Yes</div>
                                <hr />
                                {{$data['step1']['reason_of_directorschange']}}
                            @else
                                N/A
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1.14</td>
                    <td colspan="3">
                        Period in which you have been in business for which you wish to supply us with goods/services
                    </td>
                    <td colspan="3">
                        <div class="answer">
                            {{$data['step1']['business_period']}}
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1.15</td>
                    <td colspan="3">
                        Are any of the Directors, Partners, Shareholders or employees, employed by or have relatives 
                        who are currently employed by Oxygene Limited? If so declare name and position
                    </td>
                    <td colspan="3">
                        <div class="answer">
                            @if($data['step1']['has_oxygene_employee'] === 'yes')
                                {{$data['step1']['name_position']}}
                            @else
                                N/A
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1.16</td>
                    <td colspan="3">
                        Do any of the Directors, Partners, Shareholders or employees have any other interest 
                        (other than what you are seeking to supply) with persons currently employed by Oxygene 
                        Limited or other suppliers, partners or Directors of Oxygene Limited? 
                        If yes, please provide full details of interest on a separate page.
                    </td>
                    <td colspan="3">
                        <div class="answer">
                            @if($data['step1']['has_interest_employee'] === 'yes')
                                {{$data['step1']['details_of_interest']}}
                            @else
                                N/A
                            @endif
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>1.17</td>
                    <td colspan="3">
                        Contact persons within your Organization to whom enquiries about this application should be directed. 
                        (Provide two contact names)
                    </td>
                    <td  colspan="3" class="dotted_text input">
                        <div class="mb-0">
                            <label>Names (full names please) : </label>
                            <span class="answer">
                                {{$data['step1']['contact_person_name']}}
                            </span>
                        </div>
                        <div class="mb-0 pt-3">
                            <label>Title : </label>
                            <span class="answer">
                                {{$data['step1']['contact_person_title']}}
                            </span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="page-break"></div>

        <!-- Break 3 -->
        <table class="table table-borderless no-spacing" cellspacing="0" style="border-spacing: 0;">
            <tbody>
                <tr>
                    <td class="px-0">
                        <p class="mb-0"><strong>2. REFERENCES</strong></p>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered no-spacing" cellspacing="0" style="border-spacing: 0;">
            <tbody>
                <tr>
                    <td class="tw-20px">2.1</td>
                    <td class="tw-25">
                        Your Bank References
                        <br/>
                        <br/>
                        <strong>Primary contact person:</strong>
                    </td>
                    <td>
                        <div class="mb-0">
                            <label>Bank name : </label>
                            <span class="answer">
                                {{$data['step2']['bank_references']['bank_name']}}
                            </span>
                        </div>
                        <div class="mb-0 pt-3">
                            <label>Branch : </label>
                            <span class="answer">
                                {{$data['step2']['bank_references']['branch']}}
                            </span>
                        </div>
                        <div class="mb-0 pt-3">
                            <label>A/C NO. : </label>
                            <span class="answer">
                                {{$data['step2']['bank_references']['ac_no']}}
                            </span>
                        </div>
                        <div class="mb-0 pt-3">
                            <label>Name & Title : </label>
                            <span class="answer">
                                {{$data['step2']['bank_references']['name_title']}}
                            </span>
                        </div>
                        <div class="mb-0 pt-3">
                            <label>Email/telephone no. : </label>
                            <span class="answer">
                                {{$data['step2']['bank_references']['email_telno']}}
                            </span>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered mt-4 no-spacing" cellspacing="0" style="border-spacing: 0;">
            <tbody>
                <tr>
                    <td class="tw-20px">2.2</td>
                    <td class="tw-25">
                        Trade References
                    </td>
                    @foreach($data['step2']['trade_references'] as $refs)
                        <td class="input ">
                            <div class="mb-0">
                                <label>Company Name & Address : </label>
                                <span class="answer">
                                    {{$refs['company_name_addr']}}
                                </span>
                            </div>
                            <div class="mb-0 pt-3">
                                <label>Contact person (Full names) : </label>
                                <span class="answer">
                                    {{$refs['contact_person']}}
                                </span>
                            </div>
                            <div class="mb-0 pt-3">
                                <label>Position : </label>
                                <span class="answer">
                                    {{$refs['position']}}
                                </span>
                            </div>
                            <div class="mb-0 pt-3">
                                <label>Office Tel No : </label>
                                <span class="answer">
                                    {{$refs['office_telno']}}
                                </span>
                            </div>
                            <div class="mb-0 pt-3">
                                <label>Mobile Tel No : </label>
                                <span class="answer">
                                    {{$refs['mobile_telno']}}
                                </span>
                            </div>
                            <div class="mb-0 pt-3">
                                <label>Email address : </label>
                                <span class="answer">
                                    {{$refs['email_addr']}}
                                </span>
                            </div>
                        </td>
                    @endforeach
                </tr>
            </tbody>
        </table>

        <div class="page-break"></div>

        <!-- Break 4 -->
        <table class="table table-borderless no-spacing" cellspacing="0" style="border-spacing: 0;">
            <tbody>
                <tr>
                    <td class="px-0">
                        <p class="mb-0"><strong>3. LITIGATION HISTORY</strong></p>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-bordered no-spacing" cellspacing="0" style="border-spacing: 0;">
            <tbody>
                <tr>
                    <td class="tw-20px">3.1</td>
                    <td class="w-50">
                        Have you, any of the Directors or the company itself, 
                        had any litigation concerning any contract/LPO you have executed in the last 5 years? 
                        If yes, Provide details in a separate sheet showing client, cause and matter in dispute and current status of suit
                    </td>
                    <td>
                        <div class="answer">
                            @if($data['step3']['litigation'] === 'yes')
                                Attachement: Yes
                            @else
                                N/A
                            @endif
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <table class="table table-borderless no-spacing" cellspacing="0" style="border-spacing: 0;">
            <tbody>
                <tr>
                    <td class="px-0">
                        <p class="mb-0"><strong>4. EVALUATION Requirements</strong></p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <ol type="A">
                            <li>Company Personal Identification Number (PIN) (Copy)</li>
                            <li>Certificate of Tax Compliance (Copy)</li>
                            <li>VAT Registration/certificate (Copy)</li>
                            <li>Current Business License/Certificate (Copy)</li>
                            <li>Names of all Directors and Partners (In a company letterhead paper and duly signed by one director)</li>
                            <li>Directors Identity Card (ID) (Certified copies)</li>
                            <li>Directors Personal Identification Number (PIN) (Copies)</li>
                            <li>Company CR12 document (Less than 6 months from date of issue)</li>
                            <li>Certificate of Company name change if any</li>
                            <li>Passport photos of all Directors of the company (Certified photos)</li>
                            <li>Memorandum and Articles of Association (Copy)</li>
                            <li>Certificate of incorporation/Partnership deed/ Business Certificate (Copy)</li>
                            <li>Latest Audited Financial Accounts - Last two years (Copies)</li>
                            <li>Detailed Business Profile</li>
                            <li>Latest Company Returns (2020) (Copy)</li>
                            <li>Reference letters from your business references</li>
                            <li>Bank reference and bank account information letter from your bankers</li>
                        </ol>
                        
                        <p><strong>PLEASE NOTE THE ABOVE DOCUMENTS MUST BE ARRANGED AND ATTACHED FOLLOWING THE SEQUENCE ABOVE</strong></p>
                        
                        <p><strong>General Requirements</strong></p>
                        <ol type="A">
                            <li>The documents should be returned back in a sealed envelope addressed to the Procurement officer no later than 14 days from the date of receipt of this document.</li>
                            <li>Oxygene Limited will examine the documents to determine completeness, general orderliness andsufficiency in responsiveness.</li>
                            <li>The applicants should have registered offices and Oxygene Limited reserves the discretion of visiting the physical premises from which the applicant conducts business.</li>
                        </ol>

                        <div class="page-break"></div>

                        <p><strong>5. DATA PROTECTION STATEMENT</strong></p>
                        <p>Oxygène recognises and agrees that all data collected or received in the course of receiving goods and Services including but not limited to the names, addresses, telephone numbers, and any other data collected is the property and confidential information of the Supplier and shall not use the same otherwise other than as for the purpose outlined in this Agreement. Oxygène is guided by the Kenya Data Protection Act (2019) which it has adopted and incorporated into its Data Protection Policy, 2021. The policy which expounds the Company’s processing and management of data shall availed to the Supplier during contracting.</p>
                        
                        <p><strong>6. DECLARATION</strong></p>
                        <p>I/We declare that to the best of my/our knowledge the answers submitted in this form and any supporting documentation attached herewith are correct and can be substantiated if requested to do so. I/We understand that any misrepresentations will be regarded as fraudulent with intention to commit a fraudulent act against Oxygene Limited. Such misrepresentation shall form grounds for termination of the qualification process and/or blacklisting from Oxygene suppliers register or an application of any legal means to safeguard Oxygene interests. I/We further hereby give Limited or its Agents authority to seek any references it may deem fit to carry out the evaluation.</p>
                        
                        <div class="signature">
                            <div class="mb-3">
                                <label>Signed and Sealed : </label>
                                <span class="answer">
                                    {{$data['step6']['signed_sealed']}}
                                </span>
                                <!-- <span class="dotted-line"></span> -->
                            </div>
                            <div class="mb-3">
                                <label>For and on Behalf of : </label>
                                <span class="answer">
                                    {{$data['step6']['for_onbehalf_of']}}
                                </span>
                                <!-- <span class="dotted-line"></span> -->
                            </div>
                            <div class="mb-3">
                                <label>Position in : </label>
                                <span class="answer">
                                    {{$data['step6']['position_in']}}
                                </span>
                                <!-- <span class="dotted-line"></span> -->
                            </div>
                            <div class="mb-3">
                                <label>Company : </label>
                                <span class="answer">
                                    {{$data['step6']['company']}}
                                </span>
                                <!-- <span class="dotted-line"></span> -->
                            </div>
                            <div class="mb-3">
                                <label>Date : </label>
                                <span class="answer">
                                    {{$data['step6']['date']}}
                                </span>
                                <!-- <span class="dotted-line"></span> -->
                            </div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- TRADING AGREEMENT -->
        @include('pdfs.supplier.trading-agreement')
        <!-- CODE OF BUSINESS CONDUCT FOR SUPPLIERS -->
        @include('pdfs.supplier.code-conduct')

    </div>

@endsection
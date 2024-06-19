<x-guest-layout>
    @section('title', 'Online Courses')
    @include('frontend/header')
    <section class="inner-header flw">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="col-lg-9">
                <h1>Online Courses</h1>
                <p>SamUniversity Institute - Education Consultancy</p>
              </div>
            </div>
          </div>
        </div>
      </section>
  
      <section class="meetour flw">
        <div class="container">
          <div class="row align-items-center">
            <div class="col-lg-12">
              <h4 class="mb-2">Online Courses</h4>
  
              <p>
                Lorem Ipsum is simply dummy text of the printing and typesetting
                industry. Lorem Ipsum has been the industry's standard dummy text
                ever since the 1500s, when an unknown printer took a galley of
                type and scrambled it to make a type specimen book. It has
                survived not only five centuries, but also the leap into
                electronic typesetting, remaining essentially unchanged. It was
                popularised in the 1960s with the release of Letraset sheets
                containing Lorem Ipsum passages, and more recently with desktop
                publishing software like Aldus PageMaker including versions of
                Lorem Ipsum.
              </p>
  
              <table class="table table-bordered mt-4">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                  </tr>
                  <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                  </tr>
                  <tr>
                    <th scope="row">3</th>
                    <td>Larry the Bird</td>
                    <td>@twitter</td>
                    <td>@fat</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    @include('frontend/footer')

</x-guest-layout>

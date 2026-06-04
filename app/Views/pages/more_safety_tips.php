<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<!-- Page Header Start -->
<div class="container-fluid page-header py-5 mb-5 wow fadeIn" data-wow-delay="0.1s">
    <div class="container text-center py-5">
        <h1 class="display-3 text-white mb-3 animated slideInDown">More Safety Tips</h1>
        <nav aria-label="breadcrumb animated slideInDown">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item"><a class="text-white" href="<?= base_url() ?>">Home</a></li>
                <li class="breadcrumb-item"><a class="text-white" href="<?= base_url('safety-tips') ?>">Safety Tips</a>
                </li>
                <li class="breadcrumb-item text-white active" aria-current="page">More Safety Tips</li>
            </ol>
        </nav>
    </div>
</div>
<!-- Page Header End -->

<!-- More Safety Tips Start -->
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <div class="mb-5">
                    <h6 class="text-primary">More Safety Tips</h6>
                    <h1 class="mb-4">Additional Gas Cylinder Safety Tips</h1>
                    <p class="lead">Gas cylinders are very useful, but they can be dangerous if not handled properly.
                        Follow these simple safety tips to keep your home and family safe at all times.</p>
                </div>

                <div class="accordion" id="safetyAccordion">
                    <!-- Section 1: Transporting -->
                    <div class="accordion-item mb-3 border rounded shadow-sm wow fadeIn" data-wow-delay="0.1s">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                <div class="btn-lg-square bg-primary rounded-circle me-3"
                                    style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fa fa-truck text-white"></i>
                                </div>
                                <strong>Safe Transport of Gas Cylinders</strong>
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                            data-bs-parent="#safetyAccordion">
                            <div class="accordion-body">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-primary me-3 mt-1"></i>
                                        <span>Always keep the cylinder upright when moving it. Never roll or drag it on
                                            the ground.</span>
                                    </li>
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-primary me-3 mt-1"></i>
                                        <span>Make sure the valve cap is tightly closed before transporting.</span>
                                    </li>
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-primary me-3 mt-1"></i>
                                        <span>Do not leave cylinders in a hot car for a long time. Heat can cause
                                            pressure to build up inside.</span>
                                    </li>
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-primary me-3 mt-1"></i>
                                        <span>Transport cylinders in a well-ventilated area, not inside a closed
                                            room.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Section 2: Storage -->
                    <div class="accordion-item mb-3 border rounded shadow-sm wow fadeIn" data-wow-delay="0.2s">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                <div class="btn-lg-square bg-primary rounded-circle me-3"
                                    style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fa fa-warehouse text-white"></i>
                                </div>
                                <strong>Proper Storage of Gas Cylinders</strong>
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#safetyAccordion">
                            <div class="accordion-body">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-primary me-3 mt-1"></i>
                                        <span>Store cylinders in a cool, dry, and well-ventilated place away from direct
                                            sunlight.</span>
                                    </li>
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-primary me-3 mt-1"></i>
                                        <span>Keep cylinders away from heat sources like stoves, heaters, or
                                            fireplaces.</span>
                                    </li>
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-primary me-3 mt-1"></i>
                                        <span>Never store gas cylinders in basements or closed spaces where gas can
                                            build up if there is a leak.</span>
                                    </li>
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-primary me-3 mt-1"></i>
                                        <span>Always keep empty and full cylinders separate and mark them
                                            clearly.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3: Usage -->
                    <div class="accordion-item mb-3 border rounded shadow-sm wow fadeIn" data-wow-delay="0.3s">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <div class="btn-lg-square bg-primary rounded-circle me-3"
                                    style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fa fa-fire text-white"></i>
                                </div>
                                <strong>Safe Usage of Gas Cylinders</strong>
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#safetyAccordion">
                            <div class="accordion-body">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-primary me-3 mt-1"></i>
                                        <span>Always check the rubber seal (O-ring) before connecting the cylinder to
                                            the regulator. Replace it if worn out.</span>
                                    </li>
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-primary me-3 mt-1"></i>
                                        <span>Open the cylinder valve slowly. Do not force it open or use tools to turn
                                            it.</span>
                                    </li>
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-primary me-3 mt-1"></i>
                                        <span>Always turn off the cylinder valve when not in use, especially at night or
                                            before leaving home.</span>
                                    </li>
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-primary me-3 mt-1"></i>
                                        <span>Never try to repair or modify the cylinder, valve, or regulator yourself.
                                            Call a professional.</span>
                                    </li>
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-primary me-3 mt-1"></i>
                                        <span>Do not use a cylinder that looks damaged, rusty, or has dents.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Section 3b: How to Light a Gas Stove -->
                    <div class="accordion-item mb-3 border rounded shadow-sm wow fadeIn" data-wow-delay="0.35s">
                        <h2 class="accordion-header" id="headingThreeB">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThreeB" aria-expanded="false" aria-controls="collapseThreeB">
                                <div class="btn-lg-square bg-success rounded-circle me-3"
                                    style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fa fa-lightbulb text-white"></i>
                                </div>
                                <strong>How to Safely Light a Gas Stove or Burner</strong>
                            </button>
                        </h2>
                        <div id="collapseThreeB" class="accordion-collapse collapse" aria-labelledby="headingThreeB"
                            data-bs-parent="#safetyAccordion">
                            <div class="accordion-body">
                                <p class="mb-3">Lighting a gas stove the wrong way can cause a fire blast. Follow these
                                    simple steps every time you want to cook:</p>

                                <h6 class="mb-2">Before Lighting:</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2 d-flex">
                                        <i class="fa fa-check-circle text-success me-3 mt-1"></i>
                                        <span>Make sure the kitchen window or door is open for fresh air.</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <i class="fa fa-check-circle text-success me-3 mt-1"></i>
                                        <span>Check that the hose is properly connected and not cracked or worn
                                            out.</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <i class="fa fa-check-circle text-success me-3 mt-1"></i>
                                        <span>Keep all flammable items like cloth, paper, and cooking oil away from the
                                            stove.</span>
                                    </li>
                                </ul>

                                <h6 class="mb-2 mt-3">Steps to Light the Stove:</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2 d-flex">
                                        <span class="badge bg-success me-3 mt-1">Step 1</span>
                                        <span><strong>Open the cylinder valve first.</strong> Turn it slowly to let gas
                                            flow to the stove.</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <span class="badge bg-success me-3 mt-1">Step 2</span>
                                        <span><strong>Light your matchstick or gas lighter first.</strong> Hold the lit
                                            match or lighter close to the burner before turning on the stove
                                            knob.</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <span class="badge bg-success me-3 mt-1">Step 3</span>
                                        <span><strong>Turn the stove knob slowly.</strong> While holding the flame near
                                            the burner, turn the knob to release gas. The burner should light
                                            immediately.</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <span class="badge bg-success me-3 mt-1">Step 4</span>
                                        <span><strong>Adjust the flame to your needed size.</strong> A blue flame means
                                            the gas is burning well. A yellow or orange flame means there is a
                                            problem.</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <span class="badge bg-success me-3 mt-1">Step 5</span>
                                        <span><strong>If the burner does not light, turn off the knob
                                                immediately.</strong> Wait for a few minutes to let any gas that escaped
                                            clear out. Then try again with a fresh match or lighter.</span>
                                    </li>
                                </ul>

                                <div class="alert alert-danger d-flex align-items-center mb-0 mt-3" role="alert">
                                    <i class="fa fa-exclamation-circle me-2"></i>
                                    <div><strong>Never do this:</strong> Do not turn on the gas knob first and then try
                                        to find a match. Gas will fill the air and can cause a fire blast when the match
                                        comes near. Always have the flame ready before turning the knob.</div>
                                </div>

                                <h6 class="mb-2 mt-3">After Cooking:</h6>
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-2 d-flex">
                                        <i class="fa fa-check-circle text-success me-3 mt-1"></i>
                                        <span>Turn off the stove knob completely.</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <i class="fa fa-check-circle text-success me-3 mt-1"></i>
                                        <span>Close the cylinder valve tightly.</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <i class="fa fa-check-circle text-success me-3 mt-1"></i>
                                        <span>Wait for the stove to cool before cleaning or covering it.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4: Leak Detection -->
                    <div class="accordion-item mb-3 border rounded shadow-sm wow fadeIn" data-wow-delay="0.4s">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                <div class="btn-lg-square bg-primary rounded-circle me-3"
                                    style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fa fa-search text-white"></i>
                                </div>
                                <strong>How to Check for Gas Leaks</strong>
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                            data-bs-parent="#safetyAccordion">
                            <div class="accordion-body">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-primary me-3 mt-1"></i>
                                        <span>If you smell gas, do not light any matches or switch on/off electrical
                                            appliances. Sparks can cause fire.</span>
                                    </li>
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-primary me-3 mt-1"></i>
                                        <span>Apply soapy water on the cylinder valve and hose connections. If bubbles
                                            form, there is a leak.</span>
                                    </li>
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-primary me-3 mt-1"></i>
                                        <span>Never use a flame to check for leaks. This is very dangerous and can cause
                                            an explosion.</span>
                                    </li>
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-primary me-3 mt-1"></i>
                                        <span>If you find a leak, turn off the valve, open windows and doors, and move
                                            the cylinder outside if it is safe to do so.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Section 5: Emergency - Gas Cylinder Fire in Kitchen -->
                    <div class="accordion-item mb-3 border rounded shadow-sm wow fadeIn" data-wow-delay="0.5s">
                        <h2 class="accordion-header" id="headingFive">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                                <div class="btn-lg-square bg-danger rounded-circle me-3"
                                    style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fa fa-exclamation-triangle text-white"></i>
                                </div>
                                <strong>What to Do If Gas Cylinder Catches Fire in the Kitchen</strong>
                            </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive"
                            data-bs-parent="#safetyAccordion">
                            <div class="accordion-body">
                                <p class="mb-3">A gas cylinder fire in a closed kitchen is very dangerous. The fire can
                                    spread fast, and the heat can make the cylinder explode. Stay calm and follow these
                                    steps carefully:</p>

                                <h6 class="text-danger mb-2">Step-by-Step Actions:</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2 d-flex">
                                        <span class="badge bg-danger me-3 mt-1">Step 1</span>
                                        <span><strong>Stay calm and do not panic.</strong> Panic makes you make wrong
                                            choices. Take a deep breath and think clearly.</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <span class="badge bg-danger me-3 mt-1">Step 2</span>
                                        <span><strong>Do not run out and leave the fire behind.</strong> A small fire
                                            can grow very fast. If it is safe, try to put it out first.</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <span class="badge bg-danger me-3 mt-1">Step 3</span>
                                        <span><strong>Turn off the cylinder valve if you can reach it safely.</strong>
                                            Use a wet cloth or wet sack to cover your hand and turn the valve clockwise
                                            to close it. This stops more gas from feeding the fire.</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <span class="badge bg-danger me-3 mt-1">Step 4</span>
                                        <span><strong>Open all windows and doors immediately.</strong> This lets fresh
                                            air come in and pushes the gas and smoke out. It also stops gas from
                                            building up and causing a bigger explosion.</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <span class="badge bg-danger me-3 mt-1">Step 5</span>
                                        <span><strong>Do not switch on or off any electric device.</strong> Do not touch
                                            light switches, fans, or any electric button. Even a small spark can cause
                                            the gas to explode.</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <span class="badge bg-danger me-3 mt-1">Step 6</span>
                                        <span><strong>Remove other flammable items if safe.</strong> If there are
                                            cooking oil, kerosene, cloth, or paper near the fire, move them away quickly
                                            if you can do it without getting hurt.</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <span class="badge bg-danger me-3 mt-1">Step 7</span>
                                        <span><strong>Use a fire extinguisher or traditional method to put out the
                                                fire.</strong> See the traditional remedies section below for what you
                                            can use at home.</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <span class="badge bg-danger me-3 mt-1">Step 8</span>
                                        <span><strong>If the fire is too big, leave the house immediately.</strong> Tell
                                            everyone in the house to go outside. Do not go back inside for any
                                            reason.</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <span class="badge bg-danger me-3 mt-1">Step 9</span>
                                        <span><strong>Call the Fire Service from a safe distance.</strong> Use the
                                            emergency numbers listed below. Tell them your location and that it is a gas
                                            cylinder fire.</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <span class="badge bg-danger me-3 mt-1">Step 10</span>
                                        <span><strong>Warn your neighbors.</strong> Tell neighbors to stay away from the
                                            area in case the cylinder explodes.</span>
                                    </li>
                                </ul>

                                <div class="alert alert-danger d-flex align-items-center mb-0 mt-3" role="alert">
                                    <i class="fa fa-exclamation-circle me-2"></i>
                                    <div><strong>Important:</strong> Never throw water on a gas cylinder fire. Water
                                        does not stop gas from burning and can make the situation worse. Water can also
                                        cause the hot cylinder to crack.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 5b: Traditional Remedies -->
                    <div class="accordion-item mb-3 border rounded shadow-sm wow fadeIn" data-wow-delay="0.6s">
                        <h2 class="accordion-header" id="headingFiveB">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFiveB" aria-expanded="false" aria-controls="collapseFiveB">
                                <div class="btn-lg-square bg-warning rounded-circle me-3"
                                    style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fa fa-home text-white"></i>
                                </div>
                                <strong>Traditional Ways to Stop Small Gas Fires at Home</strong>
                            </button>
                        </h2>
                        <div id="collapseFiveB" class="accordion-collapse collapse" aria-labelledby="headingFiveB"
                            data-bs-parent="#safetyAccordion">
                            <div class="accordion-body">
                                <p class="mb-3">If the fire is small and just starting, you can use these simple things
                                    found at home to put it out. These methods work by cutting off the oxygen that the
                                    fire needs to burn.</p>

                                <h6 class="mb-2">Wet Sack or Wet Blanket:</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2 d-flex">
                                        <i class="fa fa-check-circle text-warning me-3 mt-1"></i>
                                        <span>Take a thick sack, jute bag, or heavy blanket and soak it in water until
                                            it is very wet.</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <i class="fa fa-check-circle text-warning me-3 mt-1"></i>
                                        <span>Carefully throw the wet sack or blanket over the burning cylinder or the
                                            burning area.</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <i class="fa fa-check-circle text-warning me-3 mt-1"></i>
                                        <span>The wet cloth will block the air from reaching the fire and the fire will
                                            die. This is one of the oldest and most effective ways to stop small
                                            fires.</span>
                                    </li>
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-warning me-3 mt-1"></i>
                                        <span>Make sure the cloth is thick and very wet. A thin or dry cloth can catch
                                            fire itself.</span>
                                    </li>
                                </ul>

                                <h6 class="mb-2">Dry Sand or Dry Soil:</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2 d-flex">
                                        <i class="fa fa-check-circle text-warning me-3 mt-1"></i>
                                        <span>If you have dry sand or dry soil at home, you can pour it over the base of
                                            the fire.</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <i class="fa fa-check-circle text-warning me-3 mt-1"></i>
                                        <span>The sand will cover the fire and stop air from reaching it. This works
                                            well for small fires on the floor.</span>
                                    </li>
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-warning me-3 mt-1"></i>
                                        <span>Keep a bucket of dry sand in the kitchen if you use gas for cooking. It is
                                            cheap and always ready.</span>
                                    </li>
                                </ul>

                                <h6 class="mb-2">Baking Soda (Sodium Bicarbonate):</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2 d-flex">
                                        <i class="fa fa-check-circle text-warning me-3 mt-1"></i>
                                        <span>If you have baking soda in the kitchen, throw a large amount directly on
                                            the fire.</span>
                                    </li>
                                    <li class="mb-2 d-flex">
                                        <i class="fa fa-check-circle text-warning me-3 mt-1"></i>
                                        <span>Baking soda releases carbon dioxide when heated, which pushes oxygen away
                                            and stops the fire.</span>
                                    </li>
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-warning me-3 mt-1"></i>
                                        <span>Note: You need a lot of baking soda. A small pinch will not work. Use at
                                            least a full cup or more.</span>
                                    </li>
                                </ul>

                                <h6 class="mb-2">Wet Mud or Clay:</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2 d-flex">
                                        <i class="fa fa-check-circle text-warning me-3 mt-1"></i>
                                        <span>In some villages and towns, people use wet mud or clay to cover small
                                            fires.</span>
                                    </li>
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-warning me-3 mt-1"></i>
                                        <span>Throw thick wet mud over the burning area. The mud blocks air and cools
                                            the fire at the same time.</span>
                                    </li>
                                </ul>

                                <h6 class="mb-2">Salt:</h6>
                                <ul class="list-unstyled">
                                    <li class="mb-2 d-flex">
                                        <i class="fa fa-check-circle text-warning me-3 mt-1"></i>
                                        <span>Plain cooking salt can also help put out small fires. Throw a large amount
                                            of salt on the fire.</span>
                                    </li>
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-warning me-3 mt-1"></i>
                                        <span>Salt works like sand. It covers the fire and stops air from reaching
                                            it.</span>
                                    </li>
                                </ul>

                                <div class="alert alert-warning d-flex align-items-center mb-0 mt-3" role="alert">
                                    <i class="fa fa-exclamation-triangle me-2"></i>
                                    <div><strong>Remember:</strong> These traditional methods only work for small fires
                                        that are just starting. If the fire is already big, leave the house and call the
                                        Fire Service immediately.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 6: Emergency Numbers -->
                    <div class="accordion-item mb-3 border rounded shadow-sm wow fadeIn" data-wow-delay="0.7s">
                        <h2 class="accordion-header" id="headingSix">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                                <div class="btn-lg-square bg-danger rounded-circle me-3"
                                    style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fa fa-phone-alt text-white"></i>
                                </div>
                                <strong>Ghana National Fire Service Emergency Numbers</strong>
                            </button>
                        </h2>
                        <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix"
                            data-bs-parent="#safetyAccordion">
                            <div class="accordion-body">
                                <p class="mb-3">Save these numbers in your phone now. Do not wait for an emergency to
                                    look for them. All calls to these numbers are free.</p>

                                <div class="bg-danger text-white p-4 rounded mb-4">
                                    <h5 class="mb-3 text-center">Emergency Hotlines (Toll-Free)</h5>
                                    <div class="row text-center">
                                        <div class="col-md-6 mb-3">
                                            <div class="bg-white text-danger rounded p-3">
                                                <h2 class="mb-1">112</h2>
                                                <small>National Emergency Number (All Networks)</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="bg-white text-danger rounded p-3">
                                                <h2 class="mb-1">192</h2>
                                                <small>Fire Service Direct Line</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-center mt-3">
                                        <p class="mb-1"><strong>Emergency Mobile:</strong> 029 934 0383</p>
                                        <p class="mb-0"><strong>Headquarters Accra:</strong> 0302 772 446</p>
                                    </div>
                                </div>

                                <h6 class="mb-3">Regional Fire Service Numbers:</h6>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>Region / Area</th>
                                                <th>Phone Number</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Greater Accra (Headquarters)</td>
                                                <td>0302-772446 / 0302-666576 / 0302-666577</td>
                                            </tr>
                                            <tr>
                                                <td>Tema (Community 1)</td>
                                                <td>0303-202518 / 0303-202554</td>
                                            </tr>
                                            <tr>
                                                <td>Ashaiman</td>
                                                <td>0303-302289</td>
                                            </tr>
                                            <tr>
                                                <td>Madina</td>
                                                <td>0302-501744</td>
                                            </tr>
                                            <tr>
                                                <td>Dansoman</td>
                                                <td>0302-669937 / 0302-310903</td>
                                            </tr>
                                            <tr>
                                                <td>Ashanti (Kumasi)</td>
                                                <td>03220-22221 / 03220-22222</td>
                                            </tr>
                                            <tr>
                                                <td>Obuasi</td>
                                                <td>03225-40247</td>
                                            </tr>
                                            <tr>
                                                <td>Central (Cape Coast)</td>
                                                <td>03321-32902 / 03321-32992</td>
                                            </tr>
                                            <tr>
                                                <td>Winneba</td>
                                                <td>03323-222104</td>
                                            </tr>
                                            <tr>
                                                <td>Eastern (Koforidua)</td>
                                                <td>03420-22233 / 03420-22339</td>
                                            </tr>
                                            <tr>
                                                <td>Volta (Ho)</td>
                                                <td>03620-26390 / 03620-26679</td>
                                            </tr>
                                            <tr>
                                                <td>Northern (Tamale)</td>
                                                <td>03720-22864 / 03720-22986</td>
                                            </tr>
                                            <tr>
                                                <td>Western (Takoradi)</td>
                                                <td>03120-21526 / 03120-21942</td>
                                            </tr>
                                            <tr>
                                                <td>Brong Ahafo (Sunyani)</td>
                                                <td>03520-27129 / 03520-27215</td>
                                            </tr>
                                            <tr>
                                                <td>Upper East (Bolgatanga)</td>
                                                <td>03820-22277</td>
                                            </tr>
                                            <tr>
                                                <td>Upper West (Wa)</td>
                                                <td>03920-22389</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="alert alert-info d-flex align-items-center mb-0 mt-3" role="alert">
                                    <i class="fa fa-info-circle me-2"></i>
                                    <div>
                                        <strong>Tips when calling for help:</strong>
                                        <ul class="mb-0 mt-2">
                                            <li>Speak clearly and give your exact location.</li>
                                            <li>Tell them it is a gas cylinder fire so they bring the right equipment.
                                            </li>
                                            <li>Stay on the line until the operator tells you to hang up.</li>
                                            <li>If possible, send someone to the main road to guide the fire truck to
                                                your house.</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 7: General Tips -->
                    <div class="accordion-item mb-3 border rounded shadow-sm wow fadeIn" data-wow-delay="0.8s">
                        <h2 class="accordion-header" id="headingSeven">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                                <div class="btn-lg-square bg-primary rounded-circle me-3"
                                    style="width: 40px; height: 40px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                    <i class="fa fa-info-circle text-white"></i>
                                </div>
                                <strong>General Safety Reminders</strong>
                            </button>
                        </h2>
                        <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven"
                            data-bs-parent="#safetyAccordion">
                            <div class="accordion-body">
                                <ul class="list-unstyled mb-0">
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-primary me-3 mt-1"></i>
                                        <span>Only buy gas cylinders from authorized and trusted dealers.</span>
                                    </li>
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-primary me-3 mt-1"></i>
                                        <span>Check the expiry date on the cylinder. Old cylinders can be unsafe.</span>
                                    </li>
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-primary me-3 mt-1"></i>
                                        <span>Keep children away from gas cylinders and teach them that it is not a
                                            toy.</span>
                                    </li>
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-primary me-3 mt-1"></i>
                                        <span>Replace old or damaged hoses and regulators every two years.</span>
                                    </li>
                                    <li class="mb-3 d-flex">
                                        <i class="fa fa-check-circle text-primary me-3 mt-1"></i>
                                        <span>Never refill gas cylinders yourself. This is illegal and very
                                            dangerous.</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="mb-5 wow fadeIn" data-wow-delay="0.1s">
                    <div class="bg-light p-4 rounded">
                        <h4 class="mb-4">Quick Safety Checklist</h4>
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fa fa-check text-primary me-2"></i>
                                <span>Is the cylinder upright?</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fa fa-check text-primary me-2"></i>
                                <span>Is the area well-ventilated?</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fa fa-check text-primary me-2"></i>
                                <span>Is the hose in good condition?</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fa fa-check text-primary me-2"></i>
                                <span>Is the O-ring seal intact?</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fa fa-check text-primary me-2"></i>
                                <span>Are there any leaks?</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fa fa-check text-primary me-2"></i>
                                <span>Is it away from heat?</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="fa fa-check text-primary me-2"></i>
                                <span>Is the valve turned off after use?</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mb-5 wow fadeIn" data-wow-delay="0.2s">
                    <div class="bg-danger text-white p-4 rounded">
                        <h4 class="mb-3"><i class="fa fa-phone-alt me-2"></i>Fire Emergency Numbers</h4>
                        <div class="bg-white text-danger rounded p-3 mb-3 text-center">
                            <h2 class="mb-0">112</h2>
                            <small>National Emergency (Free)</small>
                        </div>
                        <div class="bg-white text-danger rounded p-3 mb-3 text-center">
                            <h2 class="mb-0">192</h2>
                            <small>Fire Service Direct</small>
                        </div>
                        <p class="mb-2"><i class="fa fa-phone-alt me-2"></i>029 934 0383</p>
                        <p class="mb-2"><i class="fa fa-phone-alt me-2"></i>0302 772 446</p>
                        <p class="mb-0"><i class="fa fa-phone-alt me-2"></i>Tema: 0303-202518</p>
                    </div>
                </div>

                <div class="mb-5 wow fadeIn" data-wow-delay="0.3s">
                    <div class="bg-light p-4 rounded">
                        <h4 class="mb-3">Need Help?</h4>
                        <p class="mb-4">If you have any questions about gas cylinder safety or need a professional
                            inspection, contact us today.</p>
                        <div class="mb-3">
                            <i class="fa fa-phone-alt me-2"></i>
                            <span>+233 209235682</span>
                        </div>
                        <div class="mb-3">
                            <i class="fa fa-phone-alt me-2"></i>
                            <span>+233 506617880</span>
                        </div>
                        <div class="mb-3">
                            <i class="fa fa-envelope me-2"></i>
                            <span>info@finegasgh.com</span>
                        </div>
                        <a href="contact.html" class="btn btn-primary rounded-pill py-2 px-4 mt-3">Contact Us</a>
                    </div>
                </div>

                <div class="mb-5 wow fadeIn" data-wow-delay="0.3s">
                    <div class="bg-light p-4 rounded">
                        <h4 class="mb-3">Warning Signs</h4>
                        <ul class="list-unstyled">
                            <li class="mb-3 d-flex">
                                <i class="fa fa-exclamation-triangle text-warning me-2 mt-1"></i>
                                <span>Smell of rotten eggs or sulfur</span>
                            </li>
                            <li class="mb-3 d-flex">
                                <i class="fa fa-exclamation-triangle text-warning me-2 mt-1"></i>
                                <span>Hissing sound near the cylinder</span>
                            </li>
                            <li class="mb-3 d-flex">
                                <i class="fa fa-exclamation-triangle text-warning me-2 mt-1"></i>
                                <span>Bubbles forming on soapy water test</span>
                            </li>
                            <li class="mb-3 d-flex">
                                <i class="fa fa-exclamation-triangle text-warning me-2 mt-1"></i>
                                <span>Dizziness or difficulty breathing</span>
                            </li>
                            <li class="d-flex">
                                <i class="fa fa-exclamation-triangle text-warning me-2 mt-1"></i>
                                <span>Dead plants or animals near gas lines</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- More Safety Tips End -->
<?= $this->endSection() ?>
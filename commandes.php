
                          Activer les commandes :</b>  <input type="checkbox" id="validChange">
                        <table class="commandesTelescopeStyle" align="center" style="display:none">
                            <tr>
                                <td class="tdButton">
                                    <label class="switch">
                                        <input id="Resistance" class="switch-input" type="checkbox" <?= $statusCapteurs->verifStatut("resistanceChauffante")?>/>
                                        <span class="switch-label resistCouleur" data-on="On" data-off="Off"></span> <span class="switch-handle"></span> 
                                    </label>
                                </td>
                                <td class="tdDesc">
                                    <span class="textControl"><b>Résistance chauffante</b></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="tdButton">
                                    <label class="switch">
                                        <input id="TensionTelescope" class="switch-input" type="checkbox" <?= $statusCapteurs->verifStatut("tension")?> />
                                        <span class="switch-label" data-on="On" data-off="Off"></span> <span class="switch-handle"></span> 
                                    </label>
                                </td>
                                <td class="tdDesc">
                                    <span class="textControl"><b>Mise sous tension télescope</b></span>
                                </td>
                            </tr>
                            <tr>
                                <td class="tdButton">
                                    <label class="switch">
                                       <input id="Alarme" class="switch-input" type="checkbox" <?= $statusCapteurs->verifStatut("alarme")?> />
                                       <span class="switch-label" data-on="On" data-off="Off"></span> <span class="switch-handle"></span> 
                                    </label>
                                </td>
                                <td class="tdDesc">
                                    <span class="textControl"><b>Alarme</b></span>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                     <?= $statusCapteurs->verifStatut("toit")?> 
                                    
                                    <a href="#" id="ouvreToit" class="wakeup  blue">Ouvrir Toit</a>
                                    <a href="#" id="fermeToit" class="wakeup blue">Fermer Toit</a>
                                    <a href="#" id="arretToit" class="wakeup blue">Arrêt moteur</a>
                                <td>
                            </tr>

                        </table>
             
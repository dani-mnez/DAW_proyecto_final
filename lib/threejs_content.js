import * as THREE from "three";
import { GLTFLoader } from "/DAW_proyecto_final/lib/threejs/examples/jsm/loaders/GLTFLoader.js";
let cheese;

const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera(
    75,
    window.innerWidth / window.innerHeight,
    0.1,
    1000
);
camera.position.z = 5;
camera.position.y = 5;
camera.position.x = 5;

const renderer = new THREE.WebGLRenderer({
    alpha: true,
});

let light1 = new THREE.PointLight(0xffffff, 1);
light1.castShadow = true;
light1.position.x = 7;
light1.position.y = 5;
light1.position.z = 50;
scene.add(light1);
renderer.setSize(600, 600);
document.getElementById("landing").appendChild(renderer.domElement);

const textureLoader = new THREE.TextureLoader();
const texture = textureLoader.load(
    "/DAW_proyecto_final/assets/3dscene/textures/Cheese_baseColor.jpeg"
);
const metalness = textureLoader.load(
    "/DAW_proyecto_final/assets/3dscene/textures/Cheese_metallicRoughness.png"
);
const normal = textureLoader.load(
    "/DAW_proyecto_final/assets/3dscene/textures/Cheese_normal.png"
);

const loader = new GLTFLoader();
loader.load(
    "/DAW_proyecto_final/assets/3dscene/scene.gltf",
    function (gltf) {
        cheese = gltf.scene.children[0];
        cheese.material = new THREE.MeshStandardMaterial({
            map: texture,
            side: THREE.DoubleSide,
            metalnessMap: metalness,
            normalMap: normal,
            metalness: 1,
            roughness: 0,
        });
        cheese.scale.set(0.3, 0.3, 0.3);
        cheese.position.set(0, 0, 0);

        scene.add(cheese);

        function animate() {
            requestAnimationFrame(animate);

            // cheese.rotation.x += 0.01;
            // cheese.rotation.y += 0.01;

            renderer.render(scene, camera);
        }

        animate();
    },
    undefined,
    function (error) {
        console.error(error);
    }
);
